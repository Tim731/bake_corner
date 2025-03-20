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
</head>

<body class="bg-base-100 text-base-content flex flex-col min-h-screen">

    <div class="bg-base-300 text-base-content min-h-35 flex items-center w-full">
        <div class="navbar flex container mx-auto">
            <!-- Left Links -->
            <div class="navbar-start">
                <ul class="menu menu-horizontal px-1 hidden lg:flex space-x-4">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a></li>
                    <li><a>About</a></li>
                    <li><a>Menu</a></li>
                    <li><a>FAQ</a></li>
                </ul>
            </div>

            <!-- Logo (Centered) -->
            <div class="navbar-center">
                <a class="" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                </a>
            </div>

            <!-- User Links & Cart (Right) -->
            <div class="navbar-end">
                <ul class="menu menu-horizontal px-1 hidden lg:flex space-x-4">
                    <li><a>Login</a></li>
                    <li><a>Contact</a></li>
                    <li><a>Order</a></li>
                </ul>
                <a class="btn btn-ghost relative">
                    <i data-lucide="shopping-cart" class="text-secondary"></i>
                    <div class="badge badge-sm badge-secondary absolute -top-2 -right-2">0</div>
                </a>
            </div>
        </div>
    </div>






    <main class="w-full flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')
</body>

</html>
