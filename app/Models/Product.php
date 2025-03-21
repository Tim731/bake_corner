<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'category',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }
}
