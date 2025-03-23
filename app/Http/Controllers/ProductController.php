<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // Eager load the images relationship
        $product->load('images', 'sizes', 'extras');

        // return response()->json($product); // Remove this line
        return view('product.show', compact('product')); // Add this line
    }
}
