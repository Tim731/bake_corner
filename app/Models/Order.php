<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
        'status',
        'delivery_date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class, 'order_id', 'order_id');
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(BillingAddress::class);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(ShippingAddress::class);
    }
}
