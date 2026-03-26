<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesignAsset extends Model
{
    protected $fillable = [
        'design_id',
        'type',
        'path',
        'mime_type',
        'size',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }
}