@extends('layouts.app')

@section('content')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4">
            <div class="bg-base-100 rounded-2xl shadow-md p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/2">
                        @if ($product->images->count() > 0)
                            <div class="carousel w-full">
                                @foreach ($product->images as $image)
                                    <div id="slide-{{ $loop->index + 1 }}" class="carousel-item relative w-full">
                                        <img src="{{ asset($image->path) }}" class="w-full"
                                            alt="{{ $product->name }} - Image {{ $loop->index + 1 }}" />
                                        <div
                                            class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                            <a href="#slide-{{ $loop->index == 0 ? $product->images->count() : $loop->index }}"
                                                class="btn btn-circle">❮</a>
                                            <a href="#slide-{{ $loop->index == $product->images->count() - 1 ? 1 : $loop->index + 2 }}"
                                                class="btn btn-circle">❯</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <img src="{{ asset('images/product_placeholder.png') }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded-2xl mb-4">
                        @endif
                    </div>
                    <div class="w-full md:w-1/2">
                        <h1 class="text-3xl font-bold text-primary mb-4">{{ $product->name }}</h1>
                        <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                        <p class="text-gray-700 font-bold mb-4">${{ $product->price }}</p>
                        <div class="mb-4">
                            <h4 class="font-bold">Sizes</h4>
                            <ul class="space-y-2">
                                @foreach ($product->sizes as $size)
                                    <li>
                                        <label class="flex items-center">
                                            <input type="radio" name="size" value="{{ $size->pivot->name }}"
                                                class="radio radio-primary mr-2" />
                                            <span>{{ $size->pivot->name }} (+${{ $size->pivot->additional_price }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-bold">Extras</h4>
                            <ul class="space-y-2">
                                @foreach ($product->extras as $extra)
                                    <li>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="extras[]" value="{{ $extra->pivot->name }}"
                                                class="checkbox checkbox-primary mr-2" />
                                            <span>{{ $extra->pivot->name }} (+${{ $extra->pivot->price }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex items-center justify-start mt-auto">
                            <input type="number" value="1" min="1"
                                class="input input-bordered w-24 mr-4 quantity-input"
                                data-product-id="{{ $product->product_id }}" />
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->product_id }}">Add
                                to
                                Cart</button>
                        </div>
                        {{-- <div class="mt-4">
                            <button class="btn btn-primary" onclick="document.getElementById('checkout-form').submit();">Checkout</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Use event delegation for dynamically added elements
            $(document).on('click', '.add-to-cart-btn', function() {
                const productId = $(this).data('product-id');
                const quantityInput = $(`.quantity-input[data-product-id="${productId}"]`);
                const quantity = parseInt(quantityInput.val());
                const selectedSize = $('input[name="size"]:checked').val();
                const selectedExtras = $('input[name="extras[]"]:checked').map(function() {
                    return this.value;
                }).get();

                if (isNaN(quantity) || quantity < 1) {
                    alert('Please enter a valid quantity.');
                    return;
                }

                addToCart(productId, quantity, selectedSize, selectedExtras);
            });

            function addToCart(productId, quantity, size, extras) {
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        product_id: productId,
                        quantity: quantity,
                        size: size,
                        extras: extras
                    }),
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.success) {
                            showToast("Added to cart successfully!", "success");
                            window.updateCartCount(); // Call the global function
                        } else {
                            showToast("An error occurred while adding to cart.", "error");
                        }
                    },
                    error: function(error) {
                        console.error('There has been a problem with your AJAX operation:', error);
                        showToast("An error occurred while adding to cart.", "error");
                    }
                });
            }
        });
    </script>
@endsection
