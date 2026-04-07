<?php

namespace App\Http\Controllers;

use App\Models\CustomProductSession;
use App\Models\Design;
use App\Models\Product;
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
            'preview_image_path' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        abort_unless($product->is_customizable, 422, 'This product is not customizable.');

        if (!empty($data['design_id'])) {
            $design = Design::findOrFail($data['design_id']);
            abort_unless((int) $design->user_id === (int) $request->user()->id, 403);
            abort_unless((int) $design->product_id === (int) $product->id, 422, 'Design does not match the selected product.');
        }

        $option = !empty($data['product_option_id'])
            ? $product->options()->find($data['product_option_id'])
            : null;

        $unit_price = $option?->price_ttc ?? $product->price_ttc;

        $session = CustomProductSession::create([
            'user_id' => $request->user()->id,
            'product_id' => $data['product_id'],
            'product_option_id' => $data['product_option_id'] ?? null,
            'status' => 'draft',
            'configuration' => $data['configuration'] ?? [],
            'design_id' => $data['design_id'] ?? null,
            'preview_image_path' => $data['preview_image_path'] ?? null,
            'unit_price_snapshot' => $unit_price,
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

    public function update(Request $request, CustomProductSession $customizationSession): JsonResponse
    {
        $this->authorizeOwner($customizationSession->user_id, $request->user()->id);

        $data = $request->validate([
            'configuration' => ['nullable', 'array'],
            'design_id' => ['nullable', 'exists:designs,id'],
            'preview_image_path' => ['nullable', 'string'],
            'status' => ['nullable', 'in:draft,ready,added_to_cart,ordered'],
        ]);

        if (! empty($data['design_id'])) {
            $design = Design::findOrFail($data['design_id']);
            abort_unless((int) $design->user_id === (int) $request->user()->id, 403);
            abort_unless((int) $design->product_id === (int) $customizationSession->product_id, 422, 'Design does not match the customization session product.');
        }

        $customizationSession->update([
            'configuration' => $data['configuration'] ?? $customizationSession->configuration,
            'design_id' => $data['design_id'] ?? $customizationSession->design_id,
            'preview_image_path' => array_key_exists('preview_image_path', $data)
                ? $data['preview_image_path']
                : $customizationSession->preview_image_path,
            'status' => $data['status'] ?? $customizationSession->status,
        ]);

        return response()->json([
            'message' => 'Customization session updated.',
            'data' => $customizationSession->fresh(['product', 'productOption', 'design']),
        ]);
    }

    protected function authorizeOwner(int $ownerId, int $currentUserId): void
    {
        abort_if($ownerId !== $currentUserId, 403);
    }
}