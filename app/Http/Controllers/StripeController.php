<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipment;
use App\Models\WebhookEvent;
use App\Notifications\OrderConfirmed;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;
use Stripe\Webhook;
use Throwable;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $data = $request->validate([
            'shipping' => ['required', 'array'],
            'shipping.firstname' => ['required', 'string'],
            'shipping.lastname'  => ['required', 'string'],
            'shipping.address'   => ['required', 'string'],
            'shipping.zip'       => ['required', 'string'],
            'shipping.city'      => ['required', 'string'],
            'shipping.country'   => ['required', 'string'],
            'shipping.phone'     => ['nullable', 'string'],
        ]);

        $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);

        $cartItems = $cart->items()
            ->with(['product', 'option'])
            ->get();

        Log::info('PAYMENT_INTENT_CART_CHECK', [
            'user_id' => $user->id,
            'cart_id' => $cart->id,
            'items_count' => $cartItems->count(),
            'cart_items_ids' => $cartItems->pluck('id')->all(),
        ]);

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Panier vide'], 400);
        }

        $stripe = new StripeClient(config('services.stripe.secret', env('STRIPE_SECRET')));

        return DB::transaction(function () use ($user, $cartItems, $data, $stripe) {
            $totalTtc = 0.0;
            $totalHt  = 0.0;

            foreach ($cartItems as $ci) {
                $product = $ci->product;

                if (! $product) {
                    abort(422, 'Produit introuvable dans le panier.');
                }

                $unitTtc = $ci->option?->price_ttc ?? $product->price_ttc;
                $unitHt  = $ci->option?->price_ht ?? $product->price_ht;
                $qty = (int) $ci->quantity;

                $totalTtc += ((float) $unitTtc) * $qty;
                $totalHt  += ((float) $unitHt) * $qty;
            }

            $totalTtc = round($totalTtc, 2);
            $totalHt  = round($totalHt, 2);

            $order = Order::create([
                'user_id'        => $user->id,
                'total_ht'       => $totalHt,
                'total_ttc'      => $totalTtc,
                'payment_status' => 'pending',
                'order_status'   => 'new',
            ]);

            Shipment::create([
                'order_id'  => $order->id,
                'firstname' => $data['shipping']['firstname'],
                'lastname'  => $data['shipping']['lastname'],
                'address'   => $data['shipping']['address'],
                'zip'       => $data['shipping']['zip'],
                'city'      => $data['shipping']['city'],
                'country'   => $data['shipping']['country'],
                'phone'     => $data['shipping']['phone'] ?? null,
                'status'    => 'pending',
            ]);

            foreach ($cartItems as $ci) {
                $product = $ci->product;

                if (! $product) {
                    abort(422, 'Produit introuvable dans le panier.');
                }

                $unitTtc = $ci->option?->price_ttc ?? $product->price_ttc;
                $qty = (int) $ci->quantity;

                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $product->id,
                    'product_option_id' => $ci->product_option_id,
                    'lot_id'            => null,
                    'unit_price'        => round((float) $unitTtc, 2),
                    'quantity'          => $qty,
                    'total'             => round(((float) $unitTtc) * $qty, 2),
                ]);
            }

            $payment = Payment::create([
                'order_id'            => $order->id,
                'provider'            => 'stripe',
                'provider_payment_id' => null,
                'amount'              => $totalTtc,
                'status'              => 'pending',
                'raw_payload'         => null,
            ]);

            $intent = $stripe->paymentIntents->create([
                'amount' => (int) round($totalTtc * 100),
                'currency' => 'eur',
                'payment_method_types' => ['card'],
                'description' => "Commande #{$order->id}",
                'metadata' => [
                    'order_id'   => (string) $order->id,
                    'user_id'    => (string) $user->id,
                    'payment_id' => (string) $payment->id,
                ],
            ]);

            $payment->provider_payment_id = $intent->id;
            $payment->raw_payload = $intent->toArray();
            $payment->save();

            return response()->json([
                'order_id'          => $order->id,
                'payment_intent_id' => $intent->id,
                'client_secret'     => $intent->client_secret,
                'amount'            => $totalTtc,
                'currency'          => 'EUR',
            ]);
        });
    }

    public function webhook(Request $request): JsonResponse
    {
        Log::info('STRIPE_WEBHOOK_HIT');

        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');
        $payload = $request->getContent();
        $sig = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sig, $endpointSecret);
        } catch (Exception $e) {
            Log::error('STRIPE_WEBHOOK_SIGNATURE_FAILED', [
                'message' => $e->getMessage(),
            ]);

            return response()->json(['error' => $e->getMessage()], 400);
        }

        $provider = 'stripe';
        $providerEventId = (string) $event->id;

        try {
            $we = WebhookEvent::firstOrCreate(
                ['provider' => $provider, 'provider_event_id' => $providerEventId],
                ['event_type' => $event->type, 'payload' => $event->toArray(), 'processed_at' => null]
            );
        } catch (QueryException $e) {
            $we = WebhookEvent::where('provider', $provider)
                ->where('provider_event_id', $providerEventId)
                ->first();
        }

        if ($we && $we->processed_at) {
            return response()->json(['status' => 'already_processed']);
        }

        if ($we && empty($we->payload)) {
            $we->payload = $event->toArray();
            $we->save();
        }

        try {
            if ($event->type === 'payment_intent.succeeded') {
                $pi = $event->data->object;

                $meta = method_exists($pi->metadata, 'toArray')
                    ? $pi->metadata->toArray()
                    : (array) $pi->metadata;

                $orderId = $meta['order_id'] ?? null;
                $paymentId = $meta['payment_id'] ?? null;

                Log::info('STRIPE_WEBHOOK_RECEIVED', [
                    'type' => $event->type,
                ]);

                Log::info('STRIPE_PI_METADATA', [
                    'payment_intent_id' => $pi->id ?? null,
                    'metadata' => $meta,
                ]);

                DB::transaction(function () use ($pi, $orderId, $paymentId) {
                    if ($paymentId && ($payment = Payment::find($paymentId))) {
                        $payment->status = 'success';
                        $payment->raw_payload = $pi->toArray();
                        $payment->save();
                    }

                    if ($orderId && ($order = Order::with(['user', 'items.product'])->find($orderId))) {
                        $order->payment_status = 'paid';
                        $order->order_status = 'processing';
                        $order->save();

                        if ($order->user) {
                            $order->user->cart?->items()->delete();
                        }

                        if ($order->user && ! $order->paid_email_sent_at) {
                            $order->user->notify(new OrderConfirmed($order));
                            $order->paid_email_sent_at = now();
                            $order->save();
                        }
                    }
                });

                Log::info('STRIPE_PI_SUCCEEDED', [
                    'order_id' => $orderId,
                    'payment_id' => $paymentId,
                ]);
            }

            if ($event->type === 'payment_intent.payment_failed') {
                $pi = $event->data->object;

                $meta = method_exists($pi->metadata, 'toArray')
                    ? $pi->metadata->toArray()
                    : (array) $pi->metadata;

                $orderId = $meta['order_id'] ?? null;
                $paymentId = $meta['payment_id'] ?? null;

                DB::transaction(function () use ($pi, $orderId, $paymentId) {
                    if ($paymentId && ($payment = Payment::find($paymentId))) {
                        $payment->status = 'failed';
                        $payment->raw_payload = $pi->toArray();
                        $payment->save();
                    }

                    if ($orderId && ($order = Order::find($orderId))) {
                        $order->payment_status = 'failed';
                        $order->order_status = 'new';
                        $order->save();
                    }
                });
            }

            $we->processed_at = now();
            $we->save();

            return response()->json(['status' => 'success']);
        } catch (Throwable $e) {
            Log::error('STRIPE_WEBHOOK_FAILED', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            if ($we && method_exists($we, 'failures')) {
                $we->failures()->create([
                    'error_message' => $e->getMessage(),
                    'retry_count' => 0,
                ]);
            }

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}