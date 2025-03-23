<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $size = $request->input('size');
        $extras = $request->input('extras', []);

        // Validate the request data (optional but recommended)
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'extras' => 'nullable|array',
        ]);

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        // Add the product to the cart (you'll need to implement your cart logic here)
        // Example using session:
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
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'size' => $size,
                'extras' => $extras,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        // $count = array_sum(array_column($cart, 'quantity'));
        $count = count($cart);
        return response()->json(['count' => $count]);
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
            $product = Product::find(explode('-', $cartItemKey)[0]);
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->order_id;
            $orderDetail->product_id = $product->product_id;
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
