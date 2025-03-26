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

    public function checkout_form()
    {
        // Logic to prepare data for the checkout page
        // For example, you might want to fetch the cart items again
        // and pass them to the view.
        // You might also want to check if the cart is empty and redirect back if it is.

        // Example:
        $cartItems = session('cart', []); // Get cart items from session
        if(empty($cartItems)){
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('order.checkout', ['cartItems' => $cartItems, 'total' => $total]); // Create a checkout.index view
    }

    public function processCheckout(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'same_as_shipping' => 'nullable|boolean',
            'billing_first_name' => 'required_without:same_as_shipping|string|max:255',
            'billing_last_name' => 'required_without:same_as_shipping|string|max:255',
            'billing_address' => 'required_without:same_as_shipping|string|max:255',
            'billing_city' => 'required_without:same_as_shipping|string|max:255',
            'billing_postal_code' => 'required_without:same_as_shipping|string|max:20',
            'billing_phone' => 'required_without:same_as_shipping|string|max:20',
            'payment_method' => 'required|in:cod,card',
        ]);

        // If "same as shipping" is checked, copy shipping data to billing data
        if ($request->same_as_shipping) {
            $validatedData['billing_first_name'] = $validatedData['shipping_first_name'];
            $validatedData['billing_last_name'] = $validatedData['shipping_last_name'];
            $validatedData['billing_address'] = $validatedData['shipping_address'];
            $validatedData['billing_city'] = $validatedData['shipping_city'];
            $validatedData['billing_postal_code'] = $validatedData['shipping_postal_code'];
            $validatedData['billing_phone'] = $validatedData['shipping_phone'];
        }

        // Process the order (e.g., save to database, send confirmation email)
        // ...

        // Clear the cart
        session()->forget('cart');

        // Redirect to a thank you page or order confirmation page
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }
}
