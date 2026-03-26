<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $data = $request->validate([
            'order_status' => ['required', 'in:new,processing,shipped,delivered,canceled'],
        ]);

        $newStatus = $data['order_status'];

        return DB::transaction(function () use ($order, $newStatus) {

            // Si aucun changement, on renvoie tel quel
            if ($order->order_status === $newStatus) {
                return response()->json([
                    'message' => 'Status unchanged',
                    'order' => $order,
                ]);
            }

            $order->order_status = $newStatus;
            $order->save();

            // Envoi mail uniquement pour shipped/delivered/canceled et une seule fois
            $user = $order->user;

            if ($user) {
                if ($newStatus === 'shipped' && !$order->shipped_email_sent_at) {
                    $user->notify(new OrderStatusUpdated($order, 'shipped'));
                    $order->shipped_email_sent_at = now();
                    $order->save();
                }

                if ($newStatus === 'delivered' && !$order->delivered_email_sent_at) {
                    $user->notify(new OrderStatusUpdated($order, 'delivered'));
                    $order->delivered_email_sent_at = now();
                    $order->save();
                }

                if ($newStatus === 'canceled' && !$order->canceled_email_sent_at) {
                    $user->notify(new OrderStatusUpdated($order, 'canceled'));
                    $order->canceled_email_sent_at = now();
                    $order->save();
                }
            }

            return response()->json([
                'message' => 'Status updated',
                'order' => $order->fresh(),
            ]);
        });
    }
}