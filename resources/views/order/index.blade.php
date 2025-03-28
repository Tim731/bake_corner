@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4 ">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-primary">Place Your Order</h1>
                <p class="mt-4 text-lg text-gray-600">Select the delicious baked goods you'd like to order.</p>
            </div>
            <div class="flex flex-col md:flex-row items-center mb-8  w-full">
                <!-- Filter Dropdown -->
                <form action="{{ route('order') }}" method="GET" class="w-full md:w-auto mt-5 flex-grow">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('order') }}"
                            class="btn btn-primary {{ request('category') == null ? '' : 'btn-outline' }}">All
                            Categories</a>
                        @foreach ($categories as $cat)
                            <button type="submit" name="category" value="{{ $cat }}"
                                class="btn btn-primary {{ request('category') == $cat ? '' : 'btn-outline' }}">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif


                </form>
                <form action="{{ route('order') }}" method="GET" class="w-full md:w-auto">
                    <div class="join">
                        <div>
                            <label class="input join-item validator">
                                <i data-lucide="search" class="w-6 h-6 opacity-50"></i>
                                <input type="text" name="search" placeholder="Search…" value="{{ request('search') }}"
                                    class="w-full" />
                            </label>
                        </div>
                        <button class="btn btn-primary join-item">Search</button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($products->isEmpty())
                    <div class="col-span-full text-center">
                        <p class="text-gray-600 text-lg">No products found matching your criteria.</p>
                    </div>
                @endif
                @foreach ($products as $product)
                    <a href="{{ route('product.show', $product->product_id) }}" class="bg-base-100 rounded-2xl shadow-md p-6 flex flex-col justify-between product-card" data-product-id="{{ $product->product_id }}" style="cursor: pointer;">
                        <div>
                            @if ($product->images->count() > 0)
                                <div class="w-full h-55 overflow-hidden rounded-2xl">
                                    <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover rounded-2xl mb-4 transition-transform duration-300 hover:scale-110">
                                </div>
                            @else
                                <div class="w-full h-55 overflow-hidden rounded-2xl">
                                    <img src="{{ asset('images/product_placeholder.png') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover rounded-2xl mb-4 transition-transform duration-300 hover:scale-110">
                                </div>
                            @endif
                            <div class="p-3">
                                <h3 class="text-lg font-bold text-primary">{{ $product->name }}</h3>
                                <p class="text-gray-700 mb-2">{{ $product->description }}</p>
                                <p class="text-gray-700 font-bold mb-4">${{ $product->price }}</p>
                            </div>
                        </div>
                        {{-- <div class="flex items-center justify-between mt-auto">
                            <input type="number" value="1" min="1"
                                class="input input-bordered w-24 mr-4 quantity-input"
                                data-product-id="{{ $product->product_id }}" />
                            <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->product_id }}">Add to
                                Cart</button>
                        </div> --}}
                    </a>
                @endforeach
            </div>
            <div class="mt-8 w-full ">
                {{ $products->links('vendor.pagination.custom-tailwind') }}
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

                if (isNaN(quantity) || quantity < 1) {
                    alert('Please enter a valid quantity.');
                    return;
                }

                addToCart(productId, quantity);
            });

            function addToCart(productId, quantity) {
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
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
