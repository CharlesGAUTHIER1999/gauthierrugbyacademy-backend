<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomProductSession;
use App\Models\StockLot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $cart->load([
            'items.product.group',
            'items.product.categories.parent',
            'items.option',
            'items.customProductSession.design',
        ]);

        return response()->json($this->formatCart($cart));
    }

    public function add(AddToCartRequest $request)
    {
        $data = $request->validated();

        $qty = (int) ($data['quantity'] ?? 1);

        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $stock = StockLot::where('product_id', $data['product_id'])
            ->when($data['product_option_id'] ?? null, fn ($q) =>
            $q->where('product_option_id', $data['product_option_id'])
            )
            ->sum('quantity');

        if ($qty > (int) $stock) {
            return response()->json(['message' => 'Stock insuffisant'], 422);
        }

        $customSessionId = $data['custom_product_session_id'] ?? null;

        if ($customSessionId) {
            $session = CustomProductSession::findOrFail($customSessionId);

            abort_unless((int) $session->user_id === (int) $request->user()->id, 403);
            abort_unless((int) $session->product_id === (int) $data['product_id'], 422, 'Customization session does not match product.');

            $item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $data['product_id'],
                'product_option_id' => $data['product_option_id'] ?? null,
                'custom_product_session_id' => $customSessionId,
                'quantity' => $qty,
            ]);

            $session->update([
                'status' => 'added_to_cart',
            ]);
        } else {
            $item = CartItem::firstOrNew([
                'cart_id' => $cart->id,
                'product_id' => $data['product_id'],
                'product_option_id' => $data['product_option_id'] ?? null,
                'custom_product_session_id' => null,
            ]);

            $item->quantity = ((int) $item->quantity) + $qty;
            $item->save();
        }

        return $this->show($request);
    }

    public function update(Request $request, CartItem $item)
    {
        abort_unless($item->cart->user_id === $request->user()->id, 404);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $item->quantity = (int) $data['quantity'];
        $item->save();

        return $this->show($request);
    }

    public function destroy(Request $request, CartItem $item)
    {
        abort_unless($item->cart->user_id === $request->user()->id, 404);

        if ($item->customProductSession) {
            $item->customProductSession->update([
                'status' => 'ready',
            ]);
        }

        $item->delete();

        return $this->show($request);
    }

    private function formatCart(Cart $cart): array
    {
        $items = $cart->items->map(function ($item) {
            $product = $item->product;
            $option  = $item->option;
            $customSession = $item->customProductSession;

            $unit = $customSession?->unit_price_snapshot
                ?? $option?->price_ttc
                ?? $product->price_ttc
                ?? 0;

            $variantType = $product->group?->type;

            if (! $variantType) {
                $cat = $product->categories?->first();
                $root = $cat?->parent?->slug ?? $cat?->slug;
                $variantType = $root === 'nutrition' ? 'flavor' : 'color';
            }

            $variantTitle = $variantType === 'flavor' ? 'Goût' : 'Couleur';
            $variantValue = $product->color_label;

            $sizeLabel = null;
            if ($option && $option->type === 'size') {
                $sizeLabel = $option->label ?? $option->code;
            }

            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'custom_product_session_id' => $customSession?->id,
                'is_customized' => (bool) $customSession,
                'name' => $product->name,
                'image' => $customSession?->preview_image_path
                    ? $this->publicImageUrl($customSession->preview_image_path)
                    : ($this->publicImageUrl($product->main_image) ?? '/placeholder.jpg'),
                'quantity' => (int) $item->quantity,
                'unit_price' => round((float) $unit, 2),
                'line_total' => round((float) $unit * (int) $item->quantity, 2),
                'variant_title' => $variantValue ? $variantTitle : null,
                'variant_value' => $variantValue ?: null,
                'size' => $sizeLabel,
                'delivery_text' => 'Délai de livraison : 4–7 jours ouvrés',
                'option' => $option ? [
                    'id' => $option->id,
                    'label' => $option->label ?? $option->code,
                    'type' => $option->type,
                ] : null,
                'customization' => $customSession ? [
                    'status' => $customSession->status,
                    'preview_image_path' => $this->publicImageUrl($customSession->preview_image_path),
                    'configuration' => $customSession->configuration,
                    'design_id' => $customSession->design_id,
                ] : null,
            ];
        });

        $subtotal = (float) $items->sum('line_total');

        return [
            'items' => $items->values(),
            'count' => (int) $items->sum('quantity'),
            'subtotal' => round($subtotal, 2),
            'currency' => 'EUR',
        ];
    }

    private function publicImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'storage/')) {
            return url('/' . $path);
        }

        return url('/storage/' . $path);
    }
}