<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
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

    public function sizes()
    {
        return $this->belongsToMany(Product::class, 'product_sizes', 'product_id', 'product_id')
            ->withPivot('name', 'additional_price')
            ->withTimestamps();
    }

    public function extras()
    {
        return $this->belongsToMany(Product::class, 'product_extras', 'product_id', 'product_id')
            ->withPivot('name', 'price')
            ->withTimestamps();
    }
}
