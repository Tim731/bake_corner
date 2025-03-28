<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\BillingAddress;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

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

    public function store(Request $request)
    {
        // Validate the request data (you'll need to add validation rules)
        $validatedData = $request->validate([
            'billing_first_name' => 'required_unless:same_as_shipping,on',
            'billing_last_name' => 'required_unless:same_as_shipping,on',
            'billing_address' => 'required_unless:same_as_shipping,on',
            'billing_city' => 'required_unless:same_as_shipping,on',
            'billing_postal_code' => 'required_unless:same_as_shipping,on',
            'billing_phone' => 'required_unless:same_as_shipping,on',
            'shipping_first_name' => 'required|string',
            'shipping_last_name' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_postal_code' => 'required|string',
            'shipping_phone' => 'required|string',
            'payment_method' => 'required|string',
            'same_as_shipping' => 'nullable|string',
        ]);

        $cartItems = session('cart', []);

        // check if cart is empty
        if (empty($cartItems)) {
            return response()->json(['message' => 'Your cart is empty.'], 400);
        }

        try {
            DB::beginTransaction();

            // Create a customer (even if not logged in)
            $customer = Customer::create([
                'first_name' => $request->shipping_first_name,
                'last_name' => $request->shipping_last_name,
                'email' => $request->shipping_email ?? null, // Optional email
                'phone' => $request->shipping_phone,
                'address' => $request->shipping_address,
            ]);

            // Create the order
            $order = Order::create([
                'customer_id' => $customer->customer_id,
                'order_date' => now(),
                'total_amount' => 0, // Calculate this later
                'status' => 'pending',
            ]);

            // Create order details
            $totalAmount = 0;

            foreach ($cartItems as $item) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'subtotal' => 0, // Calculate this later
                ]);
                // Calculate subtotal and total amount
                $product = Product::find($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $orderDetail->update(['subtotal' => $subtotal]);
                $totalAmount += $subtotal;
            }
            $order->update(['total_amount' => $totalAmount]);

            // Create billing address
            if ($request->same_as_shipping == 'on') {
                BillingAddress::create([
                    'order_id' => $order->order_id,
                    'first_name' => $validatedData['shipping_first_name'],
                    'last_name' => $validatedData['shipping_last_name'],
                    'address' => $validatedData['shipping_address'],
                    'city' => $validatedData['shipping_city'],
                    'postal_code' => $validatedData['shipping_postal_code'],
                    'phone' => $validatedData['shipping_phone'],
                ]);
            } else {
                BillingAddress::create([
                    'order_id' => $order->order_id,
                    'first_name' => $validatedData['billing_first_name'],
                    'last_name' => $validatedData['billing_last_name'],
                    'address' => $validatedData['billing_address'],
                    'city' => $validatedData['billing_city'],
                    'postal_code' => $validatedData['billing_postal_code'],
                    'phone' => $validatedData['billing_phone'],
                ]);
            }

            // Create shipping address
            ShippingAddress::create([
                'order_id' => $order->order_id,
                'first_name' => $validatedData['shipping_first_name'],
                'last_name' => $validatedData['shipping_last_name'],
                'address' => $validatedData['shipping_address'],
                'city' => $validatedData['shipping_city'],
                'postal_code' => $validatedData['shipping_postal_code'],
                'phone' => $validatedData['shipping_phone'],
            ]);

            // Create payment
            $payment = Payment::create([
                'order_id' => $order->order_id,
                'payment_method' => $validatedData['payment_method'],
                'payment_status' => 'pending',
                'amount' => $totalAmount,
                'payment_date' => now(),
            ]);

            // Initialize Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a Payment Intent for iDEAL
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmount * 100, // Amount in cents
                'currency' => 'eur', // Change to your currency if needed
                'payment_method_types' => ['ideal'],
                'metadata' => [
                    'order_id' => $order->order_id,
                ],
            ]);

            // Update payment with payment intent id
            $payment->update(['payment_intent_id' => $paymentIntent->id]);

            DB::commit();

            // Return the client secret to the frontend
            return response()->json([
                'message' => 'Order placed successfully!',
                'clientSecret' => $paymentIntent->client_secret,
                'orderId' => $order->order_id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the error (log it, return an error response, etc.)
            return response()->json(['message' => 'Error placing order.', 'error' => $e->getMessage()], 500);
        }
    }

    public function success(Order $order)
    {
        // Retrieve the payment intent from Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
        $payment = Payment::where('order_id', $order->order_id)->first();
        try {
            $paymentIntent = PaymentIntent::retrieve($payment->payment_intent_id);
            if ($paymentIntent->status === 'succeeded') {
                $payment->update(['payment_status' => 'succeeded']);
                $order->update(['status' => 'processing']);
                return view('order.success', compact('order'));
            } else {
                return view('order.failed', compact('order'));
            }
        } catch (\Exception $e) {
            return view('order.failed', compact('order'));
        }
    }
}
