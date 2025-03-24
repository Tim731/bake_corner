<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bake-corner">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />


    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class=" text-base-content ">
    <div class="drawer drawer-end ">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen">
            @include('layouts.detect')
            <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-3"></div>
            <div class="bg-base-300 text-base-content min-h-35 flex items-center w-full">
                <div class="navbar flex container mx-auto">
                    <!-- Left Links -->
                    <div class="navbar-start">
                        <ul class="menu menu-horizontal px-1 hidden lg:flex space-x-4">
                            <li><a href="{{ route('home') }}"
                                    class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            </li>
                            <li><a href="{{ route('blog') }}"
                                    class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
                            </li>
                            <li><a href="{{ route('about') }}"
                                    class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                            <li><a href="{{ route('menu') }}"
                                    class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
                            </li>
                            <li><a href="{{ route('faq') }}"
                                    class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Logo (Centered) -->
                    <div class="navbar-center">
                        <a class="" href="#">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                class="h-12 w-auto object-contain">
                        </a>
                    </div>

                    <!-- User Links & Cart (Right) -->
                    <div class="navbar-end">
                        <ul class="menu menu-horizontal px-1 hidden lg:flex space-x-4">
                            <li><a>Login</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                            <li><a href="{{ route('order') }}"
                                    class="{{ request()->routeIs('order') ? 'active' : '' }}">Order</a></li>
                        </ul>
                        <label class="btn btn-ghost relative drawer-button add-to-cart" for="my-drawer-4">
                            <i data-lucide="shopping-cart" class="text-secondary"></i>
                            <div class="badge badge-sm badge-secondary absolute -top-2 -right-2" id="cartCount">0</div>
                        </label>
                        {{-- <label for="my-drawer-4" class="drawer-button btn btn-primary">Open drawer</label> --}}
                    </div>
                </div>
            </div>

            <main class="w-full flex-grow bg-base-200 ">
                @yield('content')
            </main>

            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.footer')
            {{-- <label for="my-drawer-4" class="drawer-button btn btn-primary">Open drawer</label> --}}
        </div>
        <div class="drawer-side">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="bg-base-200 text-base-content min-h-full w-100 p-4" id="cart-sidebar">
                <li class="font-bold text-lg mb-10"><a>Your Cart</a></li>
                <div id="cart-items-container" class="mt-4 space-y-4 ">
                    <!-- Empty Cart Message -->
                    <p id="empty-cart-message" class="text-center text-gray-500 italic">Your cart is empty.</p>
                    <!-- Cart Items will be added here -->
                </div>

                <!-- Cart Total -->
                <div id="cart-total-container" class="mt-6 pt-4">
                    <li class="font-bold flex justify-between">
                        Total: <span id="cart-total" class="text-blue-600">₱0.00</span>
                    </li>
                    <li>
                        <button id="checkout-button" class="btn btn-primary w-full mt-2" disabled>Checkout</button>
                    </li>
                </div>
            </ul>
        </div>
    </div>

    @yield('scripts')
    <script>
        $(document).ready(function() {
            // Function to update the cart sidebar
            function updateCartSidebar() {
                $.ajax({
                    url: "{{ route('cart.get') }}", // Fetch cart data
                    method: 'GET',
                    success: function(response) {
                        $('#cart-items-container').empty(); // Clear existing items
                        let total = 0;

                        if (response.cartItems.length > 0) {
                            $('#empty-cart-message').hide();

                            response.cartItems.forEach(item => {
                                const cartItemHtml = `
                                    <div class="card bg-base-300 rounded-lg p-2 flex justify-center">
                                        <li class="flex items-center">
                                            <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                            <div class="ml-4 flex-grow">
                                                <p class="font-semibold">${item.name}</p>
                                            </div>
                                            <div class="flex items-center space-x-2 mt-1">
                                                <input type="number" value="${item.quantity}" min="1" class="input input-bordered w-16 text-center quantity-input" data-id="${item.id}">
                                                <button class="btn btn-xs btn-error remove-from-cart flex items-center px-2 py-1" data-id="${item.id}">
                                                    X
                                                </button>
                                            </div>
                                        </li>
                                        <p class="text-blue-600 font-bold text-right">₱${(item.price * item.quantity).toFixed(2)}</p>
                                    </div>
                                `;
                                $('#cart-items-container').append(cartItemHtml);
                                total += item.price * item.quantity;
                            });

                            $('#checkout-button').prop('disabled', false);
                        } else {
                            $('#empty-cart-message').show();
                            $('#checkout-button').prop('disabled', true);
                        }

                        $('#cart-total').text('₱' + total.toFixed(2));
                        $('#cartCount').text(response.cartCount);
                    },
                    error: function(error) {
                        console.error('Error fetching cart data:', error);
                    }
                });
            }



            // Initial cart sidebar update
            updateCartSidebar();

            // Event delegation for remove from cart buttons
            $('#cart-sidebar').on('click', '.remove-from-cart', function() {
                const itemId = $(this).data('id');
                $.ajax({
                    url: "{{ route('cart.remove', '') }}" + "/" +
                        itemId, // Replace with your remove from cart endpoint
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        updateCartSidebar();
                    },
                    error: function(error) {
                        console.error('Error removing item from cart:', error);
                    }
                });
            });

            // Checkout button click event
            $('#checkout-button').click(function() {
                $('#checkout-form').submit();
            });

            $('body').on('click', '.add-to-cart', function() {
                updateCartSidebar();
            });
            // Event delegation for quantity input changes
            $('#cart-sidebar').on('change', '.quantity-input', function() {
                const itemId = $(this).data('id');
                const newQuantity = parseInt($(this).val());

                if (isNaN(newQuantity) || newQuantity < 1) {
                    $(this).val(1); // Reset to 1 if invalid
                    return;
                }

                // Update the cart item quantity (you'll need to create this endpoint)
                updateCartItemQuantity(itemId, newQuantity);
            });

            function updateCartItemQuantity(itemId, newQuantity) {
                // Implement the AJAX call to update the quantity in the cart
                // Example:
                $.ajax({
                    url: "{{ route('cart.update', '') }}" + "/" + itemId,
                    method: 'PUT', // Or PATCH
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        quantity: newQuantity
                    },
                    success: function(response) {
                        updateCartSidebar(); // Refresh the sidebar
                    },
                    error: function(error) {
                        console.error('Error updating cart item quantity:', error);
                    }
                });
            }
        });
    </script>
</body>

</html>
