<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ProductGroupSeeder extends Seeder
{
    private ?int $skuMax = null;
    private ?int $slugMax = null;

    public function run(): void
    {
        $this->disableFk();

        DB::table('products')->update([
            'group_id' => null,
            'color_code' => null,
            'color_label' => null,
        ]);

        DB::table('product_groups')->truncate();

        $this->enableFk();

        $this->skuMax = $this->getColumnMaxLen('products', 'sku', 80);
        $this->slugMax = $this->getColumnMaxLen('products', 'slug', 255);

        $c = [
            'black'      => ['code' => 'black', 'label' => 'Noir'],
            'white'      => ['code' => 'white', 'label' => 'Blanc'],
            'grey'       => ['code' => 'grey', 'label' => 'Gris'],
            'blue'       => ['code' => 'blue', 'label' => 'Bleu'],
            'green'      => ['code' => 'green', 'label' => 'Vert'],
            'purple'     => ['code' => 'purple', 'label' => 'Violet'],
            'cyan'       => ['code' => 'cyan', 'label' => 'Cyan'],
            'sage-green' => ['code' => 'sage-green', 'label' => 'Sage Green'],
            'red'        => ['code' => 'red', 'label' => 'Rouge'],
            'wood'       => ['code' => 'wood', 'label' => 'Bois'],
        ];

        $colorSlicesByProductKey = [
            'femmes-pantalons|Pantalon Classic' => [
                'grey' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'blue' => [8, 9, 10, 11],
            ],
            'hommes-pantalons|Pantalon Classic' => [
                'grey' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'blue' => [8, 9, 10, 11],
            ],

            'femmes-pantalons|Pantalon Training' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'blue' => [6, 7, 8],
            ],
            'hommes-pantalons|Pantalon Training' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'blue' => [6, 7, 8],
            ],

            'femmes-sweats|Sweat Classic' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'grey' => [6, 7, 8],
            ],
            'hommes-sweats|Sweat Classic' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'grey' => [6, 7, 8],
            ],

            'femmes-sweats|Sweat Zippe' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'red' => [6, 7, 8],
            ],
            'hommes-sweats|Sweat Zippe' => [
                'white' => [0, 1, 2],
                'black' => [3, 4, 5],
                'red' => [6, 7, 8],
            ],

            'femmes-tshirts|T-shirt Oversize' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'grey' => [8, 9, 10, 11],
            ],
            'hommes-tshirts|T-shirt Oversize' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'grey' => [8, 9, 10, 11],
            ],

            'femmes-tshirts|T-shirt Training' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'grey' => [8, 9, 10, 11],
            ],
            'hommes-tshirts|T-shirt Training' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'grey' => [8, 9, 10, 11],
            ],

            'femmes-vestes|Veste Classic' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'red' => [8, 9, 10, 11],
            ],
            'hommes-vestes|Veste Classic' => [
                'white' => [0, 1, 2, 3],
                'black' => [4, 5, 6, 7],
                'red' => [8, 9, 10, 11],
            ],

            'femmes-vestes|Veste Coupe-Vent' => [
                'green' => [0, 1, 2],
                'blue' => [3, 4, 5],
                'cyan' => [6, 7, 8],
            ],
            'hommes-vestes|Veste Coupe-Vent' => [
                'green' => [0, 1, 2],
                'blue' => [3, 4, 5],
                'cyan' => [6, 7, 8],
            ],

            'equipments-mobilite|Gym Ball' => [
                'blue' => [0, 1, 2],
                'purple' => [3, 4, 5],
            ],
            'equipments-mobilite|Tapis de sol' => [
                'purple' => [0, 1, 2],
                'sage-green' => [3, 4, 5],
            ],
        ];

        $colorsByProductKey = [
            'equipments-barres|Barre Olympique 20kg' => [$c['grey']],
            'equipments-barres|Barre Olympique 15kg' => [$c['grey']],
            'equipments-barres|Barre Curl' => [$c['grey']],
            'equipments-calisthenie|Anneaux Gym' => [$c['wood']],
            'equipments-calisthenie|Parallettes' => [$c['wood']],
            'equipments-calisthenie|Barre de traction murale' => [$c['black']],
            'equipments-mobilite|Gym Ball' => [$c['blue'], $c['purple']],
            'equipments-mobilite|Rouleau de massage' => [$c['black']],
            'equipments-mobilite|Tapis de sol' => [$c['purple'], $c['sage-green']],
            'equipments-musculation|Banc de musculation réglable' => [$c['black']],
            'equipments-musculation|Disques' => [$c['black']],
            'equipments-musculation|Hack Squat Pro' => [$c['black']],
            'equipments-musculation|Presse à jambes' => [$c['black']],
            'equipments-prepa|Air Bike' => [$c['black']],
            'equipments-prepa|Rameur Indoor' => [$c['black']],

            'femmes-pantalons|Pantalon Classic' => [$c['grey'], $c['black'], $c['blue']],
            'hommes-pantalons|Pantalon Classic' => [$c['grey'], $c['black'], $c['blue']],

            'femmes-pantalons|Pantalon Training' => [$c['white'], $c['black'], $c['blue']],
            'hommes-pantalons|Pantalon Training' => [$c['white'], $c['black'], $c['blue']],

            'femmes-sweats|Sweat Classic' => [$c['white'], $c['black'], $c['grey']],
            'hommes-sweats|Sweat Classic' => [$c['white'], $c['black'], $c['grey']],

            'femmes-sweats|Sweat Zippe' => [$c['white'], $c['black'], $c['red']],
            'hommes-sweats|Sweat Zippe' => [$c['white'], $c['black'], $c['red']],

            'femmes-tshirts|T-shirt Oversize' => [$c['white'], $c['black'], $c['grey']],
            'hommes-tshirts|T-shirt Oversize' => [$c['white'], $c['black'], $c['grey']],

            'femmes-tshirts|T-shirt Training' => [$c['white'], $c['black'], $c['grey']],
            'hommes-tshirts|T-shirt Training' => [$c['white'], $c['black'], $c['grey']],

            'femmes-vestes|Veste Classic' => [$c['white'], $c['black'], $c['red']],
            'hommes-vestes|Veste Classic' => [$c['white'], $c['black'], $c['red']],

            'femmes-vestes|Veste Coupe-Vent' => [$c['green'], $c['blue'], $c['cyan']],
            'hommes-vestes|Veste Coupe-Vent' => [$c['green'], $c['blue'], $c['cyan']],
        ];

        $flavorsByProductKey = [
            'nutrition-proteines-poudre|Whey Pure Professionnal 500g' => [
                ['code' => 'white-coconut', 'label' => 'White Coconut'],
                ['code' => 'coconut-lime', 'label' => 'Coconut & Lime'],
                ['code' => 'intense-chocolate', 'label' => 'Intense Chocolate'],
            ],
            'nutrition-proteines-poudre|Whey Pure Professionnal 900g' => [
                ['code' => 'stracciatella', 'label' => 'Stracciatella'],
                ['code' => 'cookies-cream', 'label' => 'Cookies & Cream'],
                ['code' => 'cuor-di-cioccolato-bianco', 'label' => 'Cuor di Cioccolato Bianco'],
            ],
            'nutrition-proteines-poudre|Whey Pure Professionnal 2 kg' => [
                ['code' => 'cookies-cream', 'label' => 'Cookies & Cream'],
                ['code' => 'white-chocolate-forest-fruits', 'label' => 'White Chocolate + Forest Fruits'],
            ],
            'nutrition-isolats|Isolate Pure Professionnal 500g' => [
                ['code' => 'wafer-nocciola', 'label' => 'Wafer Nocciola'],
                ['code' => 'white-chocolate-dark-cookies', 'label' => 'White Chocolate + Dark Cookies'],
                ['code' => 'caramel-hazelnut', 'label' => 'Caramel Hazelnut'],
            ],
            'nutrition-isolats|Isolate Pure Professionnal 900g' => [
                ['code' => 'chocolate-dark-cookies', 'label' => 'Chocolate + Dark Cookies'],
            ],
            'nutrition-isolats|Isolate Pure Professionnal 2 kg' => [
                ['code' => 'dark-cookies', 'label' => 'Dark Cookies'],
                ['code' => 'white-chocolate-dark-cookies', 'label' => 'White Chocolate + Dark Cookies'],
                ['code' => 'chocobounty', 'label' => 'Chocobounty'],
            ],
            'nutrition-barres|Hydro Purebar 55g' => [
                ['code' => 'white-chocolate', 'label' => 'White Chocolate'],
                ['code' => 'chocolate-banana', 'label' => 'Chocolate Banana'],
                ['code' => 'chocolate-coconut', 'label' => 'Chocolate Coconut'],
            ],
            'nutrition-barres|Isolate Purebar 50g' => [
                ['code' => 'dark-cookies', 'label' => 'Dark Cookies'],
                ['code' => 'intense-chocolate', 'label' => 'Intense Chocolate'],
                ['code' => 'wafer-nocciola', 'label' => 'Wafer Nocciola'],
            ],
            'nutrition-creatine|Creatine Micro Pure Zero Carb 250g' => [
                ['code' => 'unflavoured', 'label' => 'Unflavoured'],
            ],
            'nutrition-creatine|Creatine Micro Pure Zero Carb 500g' => [
                ['code' => 'unflavoured', 'label' => 'Unflavoured'],
            ],
            'nutrition-creatine|Creaclon Micro Pure Pro 250g' => [
                ['code' => 'unflavoured', 'label' => 'Unflavoured'],
            ],
            'nutrition-creatine|Creaclon Micro Pure Pro 500g' => [
                ['code' => 'unflavoured', 'label' => 'Unflavoured'],
            ],
        ];

        $flavorKeys = array_keys($flavorsByProductKey);

        foreach ($flavorsByProductKey as $productKey => $flavors) {
            [$categorySlug, $productName] = explode('|', $productKey, 2);

            $base = $this->findProductByCategoryAndName($categorySlug, $productName);
            if (!$base) {
                continue;
            }

            $group = ProductGroup::updateOrCreate(
                ['slug' => Str::slug($categorySlug . '-' . $productName)],
                ['name' => $productName, 'type' => 'flavor']
            );

            $baseUrls = DB::table('product_images')
                ->where('product_id', $base->id)
                ->orderBy('position')
                ->orderBy('id')
                ->pluck('url')
                ->values()
                ->toArray();

            DB::table('products')->where('id', $base->id)->update([
                'group_id' => $group->id,
                'color_code' => $flavors[0]['code'],
                'color_label' => $flavors[0]['label'],
            ]);

            $main0 = $baseUrls[0] ?? null;
            if ($main0) {
                $this->replaceProductImages((int) $base->id, [$main0, $main0]);
            }

            foreach (array_slice($flavors, 1) as $idx => $flavor) {
                $i = $idx + 1;
                $newId = $this->cloneProductVariant((int) $base->id, (int) $group->id, $flavor['code'], $flavor['label']);

                $main = $baseUrls[$i] ?? $baseUrls[0] ?? null;
                if ($newId && $main) {
                    $this->replaceProductImages((int) $newId, [$main, $main]);
                }
            }
        }

        foreach ($colorsByProductKey as $productKey => $colors) {
            if (in_array($productKey, $flavorKeys, true)) {
                continue;
            }

            [$categorySlug, $productName] = explode('|', $productKey, 2);

            $base = $this->findProductByCategoryAndName($categorySlug, $productName);
            if (!$base) {
                continue;
            }

            $group = ProductGroup::firstOrCreate(
                ['slug' => Str::slug($categorySlug . '-' . $productName)],
                ['name' => $productName, 'type' => 'color']
            );

            $baseUrls = DB::table('product_images')
                ->where('product_id', $base->id)
                ->orderBy('position')
                ->orderBy('id')
                ->pluck('url')
                ->values()
                ->toArray();

            $slicesByCode = $colorSlicesByProductKey[$productKey] ?? null;
            $canSlice = $this->hasSlicesForAllVariants($slicesByCode, $colors);

            DB::table('products')->where('id', $base->id)->update([
                'group_id' => $group->id,
                'color_code' => $colors[0]['code'],
                'color_label' => $colors[0]['label'],
            ]);

            if ($canSlice) {
                $firstCode = $colors[0]['code'];
                $urlsBase = $this->sliceUrls($baseUrls, $slicesByCode[$firstCode] ?? []);

                if (!empty($urlsBase)) {
                    $this->replaceProductImages((int) $base->id, $urlsBase);
                }

                foreach (array_slice($colors, 1) as $color) {
                    $newId = $this->cloneProductVariant((int) $base->id, (int) $group->id, $color['code'], $color['label']);
                    if (!$newId) {
                        continue;
                    }

                    $urls = $this->sliceUrls($baseUrls, $slicesByCode[$color['code']] ?? []);
                    if (!empty($urls)) {
                        $this->replaceProductImages((int) $newId, $urls);
                    } else {
                        $this->copyImagesFromBase((int) $base->id, (int) $newId);
                    }
                }
            } else {
                foreach (array_slice($colors, 1) as $color) {
                    $newId = $this->cloneProductVariant((int) $base->id, (int) $group->id, $color['code'], $color['label']);
                    if ($newId) {
                        $this->copyImagesFromBase((int) $base->id, (int) $newId);
                    }
                }
            }
        }

        $handledKeys = array_unique(array_merge(array_keys($colorsByProductKey), array_keys($flavorsByProductKey)));

        $allProducts = Product::with('categories')->get();

        foreach ($allProducts as $product) {
            $categorySlug = $this->firstCategorySlug((int) $product->id) ?? 'default';
            $productKey = $categorySlug . '|' . $product->name;

            if (in_array($productKey, $handledKeys, true)) {
                continue;
            }

            $group = ProductGroup::firstOrCreate(
                ['slug' => Str::slug($categorySlug . '-' . $product->name)],
                ['name' => $product->name, 'type' => null]
            );

            DB::table('products')->where('id', $product->id)->update([
                'group_id' => $group->id,
                'color_code' => null,
                'color_label' => null,
            ]);
        }
    }

    private function findProductByCategoryAndName(string $categorySlug, string $productName): ?Product
    {
        return Product::where('name', $productName)
            ->whereHas('categories', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            })
            ->first();
    }

    private function hasSlicesForAllVariants(?array $slicesByCode, array $colors): bool
    {
        if (!$slicesByCode || !is_array($slicesByCode)) {
            return false;
        }

        foreach ($colors as $c) {
            $code = $c['code'] ?? null;
            if (!$code || !array_key_exists($code, $slicesByCode)) {
                return false;
            }
        }

        return true;
    }

    private function sliceUrls(array $baseUrls, array $indexes): array
    {
        $out = [];

        foreach ($indexes as $idx) {
            if (isset($baseUrls[$idx])) {
                $out[] = $baseUrls[$idx];
            }
        }

        return array_values(array_unique(array_filter($out)));
    }

    private function cloneProductVariant(int $baseProductId, int $groupId, string $variantCode, string $variantLabel): int
    {
        $base = DB::table('products')->where('id', $baseProductId)->first();
        if (!$base) {
            return 0;
        }

        $now = now();
        $slug = $this->makeSlug((string) $base->slug, $variantCode);
        $sku = $this->makeSku((string) $base->sku, $variantCode);

        $newId = DB::table('products')->insertGetId([
            'supplier_id' => $base->supplier_id,
            'group_id' => $groupId,
            'name' => $base->name,
            'slug' => $slug,
            'brand' => $base->brand,
            'origin' => $base->origin,
            'color_code' => $variantCode,
            'color_label' => $variantLabel,
            'description' => $base->description,
            'price_ht' => $base->price_ht,
            'price_ttc' => $base->price_ttc,
            'vat' => $base->vat,
            'sku' => $sku,
            'barcode' => $base->barcode,
            'weight' => $base->weight,
            'attributes' => $base->attributes,
            'is_active' => $base->is_active,
            'is_customizable' => $base->is_customizable ?? false,
            'customization_mode' => $base->customization_mode,
            'allow_text_customization' => $base->allow_text_customization ?? false,
            'allow_image_upload' => $base->allow_image_upload ?? false,
            'allow_ai_generation' => $base->allow_ai_generation ?? false,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $cats = DB::table('product_category')
            ->where('product_id', $baseProductId)
            ->pluck('category_id');

        foreach ($cats as $catId) {
            DB::table('product_category')->insert([
                'product_id' => $newId,
                'category_id' => $catId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return (int) $newId;
    }

    private function replaceProductImages(int $productId, array $urls): void
    {
        $urls = array_values(array_unique(array_filter($urls)));
        if (count($urls) === 0) {
            return;
        }

        if (count($urls) === 1) {
            $urls[] = $urls[0];
        }

        $now = now();

        DB::table('product_images')->where('product_id', $productId)->delete();

        foreach ($urls as $i => $url) {
            DB::table('product_images')->insert([
                'product_id' => $productId,
                'url' => $url,
                'is_main' => $i === 0,
                'position' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function copyImagesFromBase(int $baseProductId, int $newProductId): void
    {
        $images = DB::table('product_images')
            ->where('product_id', $baseProductId)
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        if ($images->isEmpty()) {
            return;
        }

        $now = now();

        foreach ($images as $img) {
            DB::table('product_images')->insert([
                'product_id' => $newProductId,
                'url' => $img->url,
                'is_main' => (bool) $img->is_main,
                'position' => (int) $img->position,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function makeSku(string $baseSku, string $variantCode): string
    {
        $max = (int) ($this->skuMax ?? 80);

        // On garde une partie du SKU de base + variant + random pour garantir l’unicité
        $variant = strtoupper(Str::slug($variantCode));
        $random = '-' . rand(1000, 9999);

        // On réserve la place pour "-VARIANT-1234"
        $suffix = '-' . $variant . $random;
        $keep = max(1, $max - strlen($suffix));

        return substr($baseSku, 0, $keep) . $suffix;
    }

    private function makeSlug(string $baseSlug, string $variantCode): string
    {
        $max = (int) ($this->slugMax ?? 255);
        $suffix = '-' . Str::slug($variantCode);
        $keep = max(1, $max - strlen($suffix));
        return substr($baseSlug, 0, $keep) . $suffix;
    }

    private function getColumnMaxLen(string $table, string $column, int $default): int
    {
        try {
            $row = DB::selectOne(
                "SELECT CHARACTER_MAXIMUM_LENGTH AS len
                 FROM information_schema.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = ?
                   AND COLUMN_NAME = ?
                 LIMIT 1",
                [$table, $column]
            );

            $len = isset($row->len) ? (int) $row->len : 0;
            return $len > 0 ? $len : $default;
        } catch (Throwable $e) {
            return $default;
        }
    }

    private function firstCategorySlug(int $productId): ?string
    {
        return DB::table('product_category')
            ->join('categories', 'categories.id', '=', 'product_category.category_id')
            ->where('product_category.product_id', $productId)
            ->orderBy('categories.parent_id')
            ->orderBy('categories.id')
            ->value('categories.slug');
    }

    private function disableFk(): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } catch (Throwable $exception) {
        }
    }

    private function enableFk(): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (Throwable $exception) {
        }
    }
}