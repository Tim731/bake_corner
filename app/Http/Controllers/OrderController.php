<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'Order';
        $search = request('search');
        $category = request('category');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->paginate(9)
            ->withQueryString();

        $categories = Product::select('category')->distinct()->pluck('category');

        return view('order.index', compact('title', 'products', 'categories'));
    }
}
