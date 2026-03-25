<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromptHistory extends Model
{
    protected $fillable = [
        'user_id',
        'design_id',
        'prompt',
        'reworked_prompt',
        'provider',
        'status',
        'response_payload',
    ];

    protected $casts = [
        'response_payload' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }
}