<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $defaultPerPage = 12;
        $maxPerPage = 60;

        $perPage = (int)$request->query('per_page', $defaultPerPage);
        $perPage = max(1, min($perPage, $maxPerPage));

        $query = Product::active()
            ->select('products.*')
            ->whereIn('products.id', function ($sub) {
                $sub->selectRaw('MIN(id)')
                    ->from('products')
                    ->where('is_active', true)
                    ->groupBy(DB::raw('COALESCE(group_id, id)'));
            })
            ->with([
                'mainImage:id,product_id,url,is_main,position',
                'hoverImage:id,product_id,url,is_main,position',
                'categories:id,name,slug,parent_id',
                'categories.parent:id,name,slug,parent_id',
                'group:id,name,slug,type',
                'options:id,product_id,type,code,label,position',
            ]);

        if ($request->filled('gender')) {
            $gender = (string)$request->query('gender');

            $query->whereHas('categories', function ($q) use ($gender) {
                $q->where('slug', $gender)
                    ->orWhere('slug', 'like', $gender . '-%');
            });
        }

        if ($request->filled('category')) {
            $category = (string)$request->query('category');

            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($request->filled('tag')) {
            $tag = (string)$request->query('tag');

            if ($tag === 'new') {
                $query->orderByDesc('created_at')
                    ->orderByDesc('products.id');
            } elseif ($tag === 'bestseller') {
                $query->orderByDesc('products.id');
            } else {
                $query->orderByDesc('products.id');
            }
        } else {
            $query->orderByDesc('products.id');
        }

        return ProductResource::collection(
            $query->paginate($perPage)
        );
    }

    public function show(string $slug): ProductResource
    {
        $product = Product::with([
            'supplier:id,name',
            'images:id,product_id,url,is_main,position',
            'mainImage:id,product_id,url,is_main,position',
            'hoverImage:id,product_id,url,is_main,position',
            'categories:id,name,slug,parent_id',
            'categories.parent:id,name,slug,parent_id',
            'group:id,name,slug,type',
            'group.products:id,group_id,slug,color_code,color_label,is_active',
            'group.products.mainImage:id,product_id,url,is_main,position',
            'options' => function ($q) {
                $q->select('id', 'product_id', 'type', 'code', 'label', 'position')
                    ->orderBy('position')
                    ->withSum('lots as stock_qty', 'quantity');
            },
            'lots:id,product_id,product_option_id,lot_number,quantity',
        ])->where('slug', $slug)->firstOrFail();

        return new ProductResource($product);
    }
}