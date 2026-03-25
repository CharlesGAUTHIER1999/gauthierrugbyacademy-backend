<?php

namespace App\Http\Controllers;

use App\Models\CustomProductSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'product_option_id' => ['nullable', 'exists:product_options,id'],
            'configuration' => ['nullable', 'array'],
            'design_id' => ['nullable', 'exists:designs,id'],
        ]);

        $session = CustomProductSession::create([
            'user_id' => $request->user()->id,
            'product_id' => $data['product_id'],
            'product_option_id' => $data['product_option_id'] ?? null,
            'status' => 'draft',
            'configuration' => $data['configuration'] ?? [],
            'design_id' => $data['design_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Customization session created.',
            'data' => $session,
        ], 201);
    }

    public function show(CustomProductSession $customizationSession): JsonResponse
    {
        $this->authorizeOwner($customizationSession->user_id, request()->user()->id);

        return response()->json([
            'data' => $customizationSession->load(['product', 'productOption', 'design']),
        ]);
    }

    protected function authorizeOwner(int $ownerId, int $currentUserId): void
    {
        abort_if($ownerId !== $currentUserId, 403);
    }
}