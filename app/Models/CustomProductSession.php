<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomProductSession extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'product_option_id',
        'status',
        'configuration',
        'design_id',
    ];

    protected $casts = [
        'configuration' => 'array',
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
}