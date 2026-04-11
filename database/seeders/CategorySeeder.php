<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Désactivation temporaire des FK
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_category')->truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'femmes' => [
                'type' => 'clothing',
                'children' => [
                    'pantalons',
                    'sweats',
                    'vestes',
                    'tshirts',
                ],
            ],
            'hommes' => [
                'type' => 'clothing',
                'children' => [
                    'sweats',
                    'vestes',
                    'pantalons',
                    'tshirts',
                ],
            ],

            'nutrition' => [
                'type' => 'nutrition',
                'children' => [
                    'proteines-poudre',
                    'isolats',
                    'barres',
                    'creatine',
                    'boissons',
                ],
            ],

            'equipments' => [
                'type' => 'equipment',
                'children' => [
                    'barres',
                    'musculation',
                    'prepa',
                    'calisthenie',
                    'mobilite',
                ],
            ],
        ];

        foreach ($categories as $root => $config) {

            $rootCategory = Category::create([
                'name' => ucfirst($root),
                'slug' => $root,
                'type' => $config['type'],
                'position' => 0,
                'parent_id' => null,
            ]);

            foreach ($config['children'] as $childSlug) {
                Category::create([
                    'name' => ucfirst(str_replace('-', ' ', $childSlug)),
                    'slug' => $root . '-' . $childSlug,
                    'type' => $config['type'],
                    'parent_id' => $rootCategory->id,
                    'position' => 0,
                ]);
            }
        }
    }
}
