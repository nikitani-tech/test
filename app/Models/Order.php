<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_creator',
        'order_status',
        'billing_info',
        'shipping_info',
        'payment_method',
        'delivery_method',
        'order_total',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'order_total' => 0,
        'billing_info' => '{}',
        'order_status' => 'new',
    ];

    /**
     * Return order items eloquent collection
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
