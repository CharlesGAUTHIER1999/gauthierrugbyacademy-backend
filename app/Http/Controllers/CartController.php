<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
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
            'items.option'
        ]);

        return response()->json($this->formatCart($cart));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'product_option_id' => ['nullable', 'exists:product_options,id'],
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);

        $qty = (int) ($data['quantity'] ?? 1);

        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        // Vérif stock réel
        $stock = StockLot::where('product_id', $data['product_id'])
            ->when($data['product_option_id'] ?? null, fn ($q) =>
            $q->where('product_option_id', $data['product_option_id'])
            )
            ->sum('quantity');

        if ($qty > (int) $stock) {
            return response()->json(['message' => 'Stock insuffisant'], 422);
        }

        // ✅ FIX: firstOrNew pour éviter INSERT sans quantity
        $item = CartItem::firstOrNew([
        // ✅ firstOrNew pour éviter INSERT sans quantity
        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $data['product_id'],
            'product_option_id' => $data['product_option_id'] ?? null
        ]);

        $item->quantity = ((int) $item->quantity) + $qty;
        $item->save();

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

        $item->delete();

        return $this->show($request);
    }

    private function formatCart(Cart $cart)
    {
        $items = $cart->items->map(function ($item) {
            $product = $item->product;
            $option  = $item->option;

            $unit = $option?->price_ttc ?? $product->price_ttc ?? 0;

            // --- variant (Couleur / Goûts) ---
            $variantType = $product->group?->type;

            if (!$variantType) {
                $cat = $product->categories?->first();
                $root = $cat?->parent?->slug ?? $cat?->slug;
                $variantType = $root === 'nutrition' ? 'flavor' : 'color';
            }

            $variantTitle = $variantType === 'flavor' ? 'Goût' : 'Couleur';
            $variantValue = $product->color_label;

            // --- size / option label ---
            $sizeLabel = null;
            if ($option && $option->type === 'size') {
                $sizeLabel = $option->label ?? $option->code;
            }

            return [
                'id'         => $item->id,
                'product_id' => $item->product_id,
                'name'       => $product->name,
                // ✅ IMPORTANT : renvoyer URL publique, pas "products/..."
                'image'      => $this->publicImageUrl($product->main_image) ?? '/placeholder.jpg',
                'quantity'   => (int) $item->quantity,
                'unit_price' => round((float) $unit, 2),
                'line_total' => round((float) $unit * (int) $item->quantity, 2),
                'variant_title' => $variantValue ? $variantTitle : null,
                'variant_value' => $variantValue ?: null,
                'size'          => $sizeLabel,
                'delivery_text' => 'Délai de livraison : 4–7 jours ouvrés',
                'option' => $option ? [
                    'id'    => $option->id,
                    'label' => $option->label ?? $option->code,
                    'type'  => $option->type,
                ] : null,
            ];
        });

        $subtotal = (float) $items->sum('line_total');

        return [
            'items'    => $items->values(),
            'count'    => (int) $items->sum('quantity'),
            'subtotal' => round($subtotal, 2),
            'currency' => 'EUR',
        ];
    }

    /**
     * Transforme "products/xxx.jpg" (DB) en URL publique "/storage/products/xxx.jpg"
     * ou laisse tel quel si déjà une URL absolue.
     */
    private function publicImageUrl(?string $path): ?string
    {
        if (!$path) return null;

        // Déjà une URL complète
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // Normalise
        $path = ltrim($path, '/');

        // DB contient déjà storage/...
        if (Str::startsWith($path, 'storage/')) {
            return url('/' . $path);
        }

        // DB contient products/...
        return url('/storage/' . $path);

        // fallback générique
    }
}
