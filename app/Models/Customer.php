<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}
