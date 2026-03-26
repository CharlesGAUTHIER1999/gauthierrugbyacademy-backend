<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Fallback si mainImage/hoverImage pas chargés
        $mainFromImages  = $this->relationLoaded('images') ? $this->images->firstWhere('is_main', true) : null;
        $hoverFromImages = $this->relationLoaded('images') ? $this->images->firstWhere('is_main', false) : null;

        $main  = $this->relationLoaded('mainImage') ? $this->mainImage : $mainFromImages;
        $hover = $this->relationLoaded('hoverImage') ? $this->hoverImage : $hoverFromImages;

        $mainUrl = is_object($main)
            ? $main->full_url
            : (is_string($main) ? asset('storage/' . ltrim($main, '/')) : null);

        $hoverUrl = is_object($hover)
            ? $hover->full_url
            : (is_string($hover) ? asset('storage/' . ltrim($hover, '/')) : null);

        $variantType = $this->group?->type ?: $this->inferVariantTypeFromCategories();
        $variantName = $variantType === 'flavor' ? 'Goûts' : 'Couleurs';

        return [
            'id'   => $this->id,
            'slug' => $this->slug,

            'name'        => $this->name,
            'description' => $this->description,
            'price_ht'    => $this->price_ht,
            'price_ttc'   => $this->price_ttc,
            'vat'         => $this->vat,

            'color_code'  => $this->color_code,
            'color_label' => $this->color_label,

            'variant_type'        => $variantType,
            'variant_name'        => $variantName,
            'variant_value_code'  => $this->color_code,
            'variant_value_label' => $this->color_label,

            'flavor_code'  => $variantType === 'flavor' ? $this->color_code : null,
            'flavor_label' => $variantType === 'flavor' ? $this->color_label : null,

            'group' => $this->whenLoaded('group', fn () => [
                'id'   => $this->group?->id,
                'name' => $this->group?->name,
                'type' => $this->group?->type,
            ]),

            'main_image'  => $mainUrl,
            'hover_image' => $hoverUrl,

            // Galerie complète (uniquement en détail quand images est chargé)
            'images' => $this->whenLoaded('images', function () {
                return $this->images
                    ->sortBy(function ($img) {
                        return ((int) ($img->position ?? 0)) * 1000000 + (int) $img->id;
                    })
                    ->values()
                    ->map(fn ($img) => [
                        'id'       => $img->id,
                        'url'      => $img->full_url,
                        'is_main'  => (bool) $img->is_main,
                        'position' => (int) ($img->position ?? 0),
                    ]);
            }),

            'supplier' => $this->whenLoaded('supplier', fn () => [
                'id'   => $this->supplier?->id,
                'name' => $this->supplier?->name,
            ]),

            'categories' => $this->whenLoaded('categories', function () {
                return $this->categories->map(fn ($cat) => [
                    'id'   => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                ])->values();
            }),

            'sizes_preview' => $this->whenLoaded('options', function () {
                return $this->options
                    ->where('type', 'size')
                    ->pluck('code')
                    ->values();
            }),

            'options' => $this->whenLoaded('options', function () {
                return $this->options->map(fn ($o) => [
                    'id'        => $o->id,
                    'type'      => $o->type,
                    'code'      => $o->code,
                    'label'     => $o->label,
                    'stock_qty' => (int) ($o->stock_qty ?? 0),
                    'in_stock'  => ((int) ($o->stock_qty ?? 0)) > 0,
                ])->values();
            }),

            'lots' => $this->whenLoaded('lots', function () {
                return $this->lots->map(fn ($lot) => [
                    'id'       => $lot->id,
                    'label'    => $lot->lot_number,
                    'quantity' => (int) $lot->quantity,
                    'in_stock' => (int) $lot->quantity > 0,
                ])->values();
            }),

            'variants' => $this->when(
                $this->relationLoaded('group') && $this->group && $this->group->relationLoaded('products'),
                function () use ($variantType, $variantName) {
                    return $this->group->products->map(function ($p) use ($variantType, $variantName) {
                        $img = $p->relationLoaded('mainImage')
                            ? $p->mainImage
                            : null;

                        $url = is_object($img)
                            ? $img->full_url
                            : (is_string($img) ? asset('storage/' . ltrim($img, '/')) : null);

                        return [
                            'id'   => $p->id,
                            'slug' => $p->slug,

                            'color_code'  => $p->color_code,
                            'color_label' => $p->color_label,

                            'variant_type'        => $variantType,
                            'variant_name'        => $variantName,
                            'variant_value_code'  => $p->color_code,
                            'variant_value_label' => $p->color_label,

                            'flavor_code'  => $variantType === 'flavor' ? $p->color_code : null,
                            'flavor_label' => $variantType === 'flavor' ? $p->color_label : null,

                            'thumb_url' => $url,
                        ];
                    })->values();
                }
            ),

            'is_customizable' => (bool) $this->is_customizable,

            'customization' => [
                'mode' => $this->customization_mode,
                'text' => (bool) $this->allow_text_customization,
                'image' => (bool) $this->allow_image_upload,
                'ai' => (bool) $this->allow_ai_generation,
            ],

            'is_active'  => (bool) $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }

    private function inferVariantTypeFromCategories(): ?string
    {
        if (! $this->relationLoaded('categories')) return null;

        $cat = $this->categories->first();
        if (! $cat) return null;

        $root = $cat->parent?->slug ?? $cat->slug;

        return $root === 'nutrition' ? 'flavor' : 'color';
    }
}
