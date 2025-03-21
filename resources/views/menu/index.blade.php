@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-primary">Our Menu</h1>
                <p class="mt-4 text-lg text-gray-600">Explore our delicious selection of baked goods.</p>
            </div>

            <!-- Cakes Section -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-primary mb-6">Cakes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cake Item 1 -->
                    <div class="bg-base-100 rounded-2xl shadow-md p-6">
                        <img src="{{ asset('images/ube_cake.jpg') }}" alt="Ube Cake"
                            class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-lg font-bold text-primary">Ube Cake</h3>
                        <p class="text-gray-700">A moist and flavorful cake made with ube (purple yam).</p>
                        <p class="text-gray-700 mt-2 font-bold">$25.00</p>
                    </div>
                    <!-- Cake Item 2 -->
                    <div class="bg-base-100 rounded-2xl shadow-md p-6">
                        <img src="{{ asset('images/chocolate_cake.png') }}" alt="Chocolate Cake"
                            class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-lg font-bold text-primary">Chocolate Cake</h3>
                        <p class="text-gray-700">A rich and decadent chocolate cake.</p>
                        <p class="text-gray-700 mt-2 font-bold">$30.00</p>
                    </div>
                    <!-- Add more cake items here -->
                </div>
            </div>

            <!-- Cookies Section -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-primary mb-6">Cookies</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cookie Item 1 -->
                    <div class="bg-base-100 rounded-2xl shadow-md p-6">
                        <img src="{{ asset('images/cookies.jpg') }}" alt="Chocolate Chip Cookies"
                            class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-lg font-bold text-primary">Chocolate Chip Cookies</h3>
                        <p class="text-gray-700">Classic chocolate chip cookies, baked to perfection.</p>
                        <p class="text-gray-700 mt-2 font-bold">$10.00</p>
                    </div>
                    <!-- Add more cookie items here -->
                </div>
            </div>

            <!-- Brownies Section -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-primary mb-6">Brownies</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Brownie Item 1 -->
                    <div class="bg-base-100 rounded-2xl shadow-md p-6">
                        <img src="{{ asset('images/brownies.jpg') }}" alt="Fudge Brownies"
                            class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-lg font-bold text-primary">Fudge Brownies</h3>
                        <p class="text-gray-700">Rich and fudgy brownies, perfect for any chocolate lover.</p>
                        <p class="text-gray-700 mt-2 font-bold">$15.00</p>
                    </div>
                    <!-- Add more brownie items here -->
                </div>
            </div>

            <!-- Cupcakes Section -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-primary mb-6">Cupcakes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cupcake Item 1 -->
                    <div class="bg-base-100 rounded-2xl shadow-md p-6">
                        <img src="{{ asset('images/cupcake.jpg') }}" alt="Vanilla Cupcakes"
                            class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-lg font-bold text-primary">Vanilla Cupcakes</h3>
                        <p class="text-gray-700">Delicious vanilla cupcakes with creamy frosting.</p>
                        <p class="text-gray-700 mt-2 font-bold">$12.00</p>
                    </div>
                    <!-- Add more cupcake items here -->
                </div>
            </div>
        </div>
    </div>
@endsection
