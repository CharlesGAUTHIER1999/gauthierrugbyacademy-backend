<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Design extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'product_option_id',
        'name',
        'prompt',
        'status',
        'image_path',
        'preview_url',
        'provider',
        'provider_job_id',
        'metadata',
        'configuration'
    ];

    protected $casts = [
        'metadata' => 'array',
        'configuration' => 'array'
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

    public function assets(): HasMany {
        return $this->hasMany(DesignAsset::class);
    }
}