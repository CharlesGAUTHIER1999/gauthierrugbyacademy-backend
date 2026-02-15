<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()
            ->orders()
            ->with([
                'items.product:id,name,slug',
                'items.option:id,label,type',
                'payment:id,order_id,provider,status,amount,created_at',
                'shipment:id,order_id,firstname,lastname,address,zip,city,country,phone,carrier,tracking_url,status',
            ])
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        // ✅ empêche un user de lire la commande d'un autre
        abort_unless($order->user_id === $request->user()->id, 404);

        $order->load([
            'items.product:id,name,slug',
            'items.option:id,label,type',
            'payment:id,order_id,provider,status,amount,created_at,provider_payment_id',
            'shipment:id,order_id,firstname,lastname,address,zip,city,country,phone,carrier,tracking_url,status',
        ]);

        return response()->json($order);
    }

    public function store(): JsonResponse
    {
        return response()->json([
            'message' => 'Use POST /payment/intent to create an order.',
        ], 405);
    }
}
