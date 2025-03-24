<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage; // Import the ProductImage model
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $size = $request->input('size');
        $extras = $request->input('extras', []);

        // Validate the request data
        $request->validate([
            'product_id' => 'required|exists:products,product_id', // Correct validation rule
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'extras' => 'nullable|array',
        ]);

        $product = Product::with('images')->find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        // Get the first image URL (or null if no images)
        $firstImageUrl = null;
        if ($product->images->isNotEmpty()) {
            $firstImageUrl = asset($product->images->first()->path); // Assuming 'path' is the column name
        }

        // Add the product to the cart
        $cart = session()->get('cart', []);

        $cartItemKey = $productId;
        if ($size) {
            $cartItemKey .= '-size-' . $size;
        }
        if (!empty($extras)) {
            sort($extras);
            $cartItemKey .= '-extras-' . implode('-', $extras);
        }

        if (isset($cart[$cartItemKey])) {
            $cart[$cartItemKey]['quantity'] += $quantity;
        } else {
            $cart[$cartItemKey] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'size' => $size,
                'extras' => $extras,
                'image' => $firstImageUrl, // Store only the first image URL
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }

    public function get()
    {
        // session()->forget('cart');
        $cart = Session::get('cart', []);
        $cartItems = [];

        foreach ($cart as $key => $item) {
            $cartItems[] = [
                'id' => $key,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image'], // Now this is a single URL
            ];

        }

        return response()->json([
            'cartItems' => $cartItems,
            'cartCount' => count($cartItems),
        ]);
    }

    public function remove($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            Session::put('cart', $cart);
            return response()->json(['message' => 'Item removed from cart'], 200);
        } else {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = count($cart);
        return response()->json(['count' => $count]);
    }

    public function update(Request $request, $itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return response()->json(['message' => 'Item quantity updated'], 200);
        } else {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('order')->with('error', 'Your cart is empty.');
        }

        // Create a new order
        $order = new Order();
        // Set other order details (e.g., user_id, total, etc.)
        $order->total = 0;
        $order->save();

        // Create order details for each item in the cart
        foreach ($cart as $cartItemKey => $cartItem) {
            $product = Product::find($cartItem['product_id']);
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id; // Changed to 'id'
            $orderDetail->product_id = $cartItem['product_id'];
            $orderDetail->quantity = $cartItem['quantity'];
            $orderDetail->subtotal = $cartItem['quantity'] * $cartItem['price'];
            $orderDetail->size = $cartItem['size'];
            $orderDetail->extras = json_encode($cartItem['extras']);
            $orderDetail->save();
            $order->total += $orderDetail->subtotal;
        }
        $order->save();

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('order')->with('success', 'Order placed successfully!');
    }
}
