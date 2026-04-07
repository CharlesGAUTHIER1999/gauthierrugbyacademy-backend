<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_option_id',
        'custom_product_session_id',
        'lot_id',
        'unit_price',
        'quantity',
        'total',
        'customization_snapshot',
        'customization_preview_path',
    ];

    protected $casts = [
        'customization_snapshot' => 'array',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function option()
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id');
    }

    public function lot() {
        return $this->belongsTo(StockLot::class);
    }

    public function customProductSession(): BelongsTo
    {
        return $this->belongsTo(CustomProductSession::class);
    }
}
