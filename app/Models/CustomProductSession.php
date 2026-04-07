<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomProductSession extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'product_option_id',
        'status',
        'configuration',
        'design_id',
        'preview_image_path',
        'unit_price_snapshot',
    ];

    protected $casts = [
        'configuration' => 'array',
        'unit_price_snapshot' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }

    public function cartItems(): HasMany {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }
}