<?php

namespace App\Services\Payments;

use App\Models\Order;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentService
{
    /**
     * @throws ApiErrorException
     */
    public function createPaymentIntent(Order $order): PaymentIntent
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return PaymentIntent::create([
            'amount' => (int) round($order->total_amount * 100),
            'currency' => strtolower($order->currency ?? 'eur'),
            'metadata' => [
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ],
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    }
}