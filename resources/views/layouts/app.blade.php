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
                        <label class="btn btn-ghost relative drawer-button" for="my-drawer-4" >
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
            <ul class="menu bg-base-200 text-base-content min-h-full w-100 p-4">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
