<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'group_id',
        'name',
        'slug',
        'brand',
        'origin',
        'color_code',
        'color_label',
        'description',
        'price_ht',
        'price_ttc',
        'vat',
        'sku',
        'barcode',
        'weight',
        'is_active',
        'attributes',
        'is_customizable',
        'customization_mode',
        'allow_text_customization',
        'allow_image_upload',
        'allow_ai_generation',
    ];

    protected $casts = [
        'price_ht'   => 'float',
        'price_ttc'  => 'float',
        'vat'        => 'float',
        'weight'     => 'float',
        'is_active'  => 'boolean',
        'attributes' => 'array',
        'group_id'   => 'integer',
        'is_customizable' => 'boolean',
        'allow_text_customization' => 'boolean',
        'allow_image_upload' => 'boolean',
        'allow_ai_generation' => 'boolean',
    ];

    protected $appends = [
        'main_image',
        'hover_image',
    ];

    /* ================= RELATIONS ================= */

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id');
    }

    public function variants()
    {
        return $this->hasMany(Product::class, 'group_id', 'group_id')
            ->whereKeyNot($this->getKey())
            ->orderBy('color_code');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('position')->orderBy('id');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_main', true)
            ->orderBy('position')
            ->orderBy('id');
    }

    public function hoverImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_main', false)
            ->orderBy('position')
            ->orderBy('id');
    }

    public function options() {
        return $this->hasMany(ProductOption::class)->orderBy('position');
    }

    public function lots()
    {
        return $this->hasMany(StockLot::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /* ================= ACCESSORS ================= */

    public function getMainImageAttribute(): ?string
    {
        return $this->images
            ->firstWhere('is_main', true)
            ?->url;
    }

    public function getHoverImageAttribute(): ?string
    {
        return $this->images
            ->firstWhere('is_main', false)
            ?->url;
    }

    /* ================= SCOPES ================= */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}