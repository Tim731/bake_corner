@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <h1 class="text-5xl font-bold text-primary text-center mb-8">Checkout</h1>

        @if (session('error'))
            <div class="alert alert-error shadow-lg mb-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Cart Summary -->
            <div class="bg-base-100 rounded-2xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Order Summary</h2>
                <div id="checkout-cart-items-container" class="space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                    class="w-16 h-16 object-cover rounded-md shadow-sm">
                                <div class="ml-4">
                                    <p class="font-semibold">{{ $item['name'] }}</p>
                                    <p class="text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <p class="text-blue-600 font-bold">₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-4 border-t border-gray-300">
                    <div class="font-bold flex justify-between">
                        Total: <span id="checkout-cart-total" class="text-blue-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping & Billing Information -->
            <div class="bg-base-100 rounded-2xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Shipping & Billing Information</h2>
                <form id="payment-form">
                    @csrf
                    <!-- Shipping Address -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Shipping Address</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="shipping_first_name" class="block mb-1">First Name</label>
                                <input type="text" id="shipping_first_name" name="shipping_first_name"
                                    class="input input-bordered w-full" required>
                            </div>
                            <div>
                                <label for="shipping_last_name" class="block mb-1">Last Name</label>
                                <input type="text" id="shipping_last_name" name="shipping_last_name"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="shipping_address" class="block mb-1">Address</label>
                            <input type="text" id="shipping_address" name="shipping_address"
                                class="input input-bordered w-full" required>
                        </div>
                        <div class="mt-2">
                            <label for="shipping_city" class="block mb-1">City</label>
                            <input type="text" id="shipping_city" name="shipping_city"
                                class="input input-bordered w-full" required>
                        </div>
                        <div class="mt-2">
                            <label for="shipping_postal_code" class="block mb-1">Postal Code</label>
                            <input type="text" id="shipping_postal_code" name="shipping_postal_code"
                                class="input input-bordered w-full" required>
                        </div>
                        <div class="mt-2">
                            <label for="shipping_phone" class="block mb-1">Phone Number</label>
                            <input type="text" id="shipping_phone" name="shipping_phone"
                                class="input input-bordered w-full" required>
                        </div>
                        <div class="mt-2">
                            <label for="shipping_email" class="block mb-1">Email Address</label>
                            <input type="email" id="shipping_email" name="shipping_email"
                                class="input input-bordered w-full">
                        </div>
                    </div>

                    <!-- Billing Address (Checkbox to use shipping address) -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Billing Address</h3>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <input type="checkbox" id="same_as_shipping" name="same_as_shipping"
                                    class="checkbox checkbox-primary" checked />
                                <span class="label-text ml-2">Same as Shipping Address</span>
                            </label>
                        </div>
                        <div id="billing_address_fields">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_first_name" class="block mb-1">First Name</label>
                                    <input type="text" id="billing_first_name" name="billing_first_name"
                                        class="input input-bordered w-full" required>
                                </div>
                                <div>
                                    <label for="billing_last_name" class="block mb-1">Last Name</label>
                                    <input type="text" id="billing_last_name" name="billing_last_name"
                                        class="input input-bordered w-full" required>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="billing_address" class="block mb-1">Address</label>
                                <input type="text" id="billing_address" name="billing_address"
                                    class="input input-bordered w-full" required>
                            </div>
                            <div class="mt-2">
                                <label for="billing_city" class="block mb-1">City</label>
                                <input type="text" id="billing_city" name="billing_city"
                                    class="input input-bordered w-full" required>
                            </div>
                            <div class="mt-2">
                                <label for="billing_postal_code" class="block mb-1">Postal Code</label>
                                <input type="text" id="billing_postal_code" name="billing_postal_code"
                                    class="input input-bordered w-full" required>
                            </div>
                            <div class="mt-2">
                                <label for="billing_phone" class="block mb-1">Phone Number</label>
                                <input type="text" id="billing_phone" name="billing_phone"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <h3 class="font-semibold mb-2">Payment Method</h3>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" class="radio radio-primary"
                                    checked />
                                <span class="label-text ml-2">Cash on Delivery (COD)</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <input type="radio" name="payment_method" value="card"
                                    class="radio radio-primary" />
                                <span class="label-text ml-2">Card Payment</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Place Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            // Toggle billing address fields based on checkbox
            $('#same_as_shipping').change(function() {
                if (this.checked) {
                    $('#billing_address_fields').hide();
                    $('#billing_address_fields input').prop('required', false);
                } else {
                    $('#billing_address_fields').show();
                    $('#billing_address_fields input').prop('required', true);
                }
            }).change(); // Trigger on load

            const stripe = Stripe("{{ config('services.stripe.key') }}"); // Your publishable key
            const form = $('#payment-form');
            const submitButton = $('#submit-button');

            form.on('submit', function(event) {
                event.preventDefault();

                // Disable the submit button to prevent multiple clicks
                submitButton.prop('disabled', true);

                // Get the form data
                let formData = new FormData(this);
                formData.append('payment_method', 'ideal');

                // Send the form data to the server to create the order and payment intent
                $.ajax({
                    url: "{{ route('order.processCheckout') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // Redirect to the iDEAL payment page
                        stripe.confirmIdealPayment(data.clientSecret, {
                            payment_method: {
                                ideal: {
                                    bank: 'abn_amro', // Change this to the selected bank
                                },
                            },
                            return_url: window.location.origin + "{{ route('order.success', '') }}" +
                                data.orderId,
                        }).then(function(result) {
                            if (result.error) {
                                console.error(result.error.message);
                            } else {
                                console.log('Payment successful!');
                            }
                        });
                    },
                    error: function(xhr) {
                        let errorResponse = xhr.responseJSON;
                        console.error(errorResponse.message, errorResponse.error);
                    },
                    complete: function() {
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
