<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_ht',
        'total_ttc',
        'payment_status',
        'order_status',

        // ✅ email tracking columns
        'paid_email_sent_at',
        'shipped_email_sent_at',
        'delivered_email_sent_at',
        'canceled_email_sent_at',
    ];

    protected $casts = [
        'paid_email_sent_at'      => 'datetime',
        'shipped_email_sent_at'   => 'datetime',
        'delivered_email_sent_at' => 'datetime',
        'canceled_email_sent_at'  => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
