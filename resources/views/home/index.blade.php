@extends('layouts.app')

@section('content')
    <div class="hero bg-accent text-base-300">
        <div class="hero-content flex flex-col justify-between lg:flex-row min-h-140 container">
            <!-- Image on the left -->
            <img src="{{ asset('images/chocolate_cake.png') }}"
                class="max-w-sm rounded-lg shadow-2xl mr-0 lg:mr-5" />

            <!-- Text on the right -->
            <div class="text-center lg:text-left">
                <h1 class="text-6xl font-bold font-serif">Cakes Resolve Conflicts</h1>
                <p class="py-6 italic font-serif">
                    "We want to share some famous and homemade Filipino 'Pinoy' delicacies to the neighborhood!"
                </p>
                <button class="btn btn-secondary btn-xl">Order now</button>
            </div>
        </div>
    </div>

    <div class="flex items-center w-full">
        <div
            class="flex flex-col lg:flex-row justify-between my-5 lg:my-12 container mx-auto lg:gap-6 gap-y-4">
            <a class="card bg-base-300 w-70 shadow-sm cursor-pointer rounded-4xl" href="#">
                <div class="card-body items-center text-center">
                    <h1 class="card-title text-2xl font-serif">Cakes</h1>
                </div>
                <figure class="h-[210px] w-full overflow-hidden">
                    <img class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                        src="{{ asset('images/ube_cake.jpg') }}" alt="Cakes" />
                </figure>
                <div class="card-body items-center text-center">
                    <h5 class="card-title">Custom cakes</h5>
                </div>
            </a>
            <a class="card bg-base-300 w-70 shadow-sm cursor-pointer rounded-4xl" href="#">
                <div class="card-body items-center text-center">
                    <h1 class="card-title text-2xl font-serif">Cookies</h1>
                </div>
                <figure class="h-[210px] w-full overflow-hidden">
                    <img class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                        src="{{ asset('images/cookies.jpg') }}" alt="cookies" />
                </figure>
                <div class="card-body items-center text-center">
                    <h5 class="card-title">Delicious cookies</h5>
                </div>
            </a>
            <a class="card bg-base-300 w-70 shadow-sm cursor-pointer rounded-4xl" href="#">
                <div class="card-body items-center text-center">
                    <h1 class="card-title text-2xl font-serif">Brownies</h1>
                </div>
                <figure class="h-[210px] w-full overflow-hidden">
                    <img class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                        src="{{ asset('images/brownies.jpg') }}" alt="brownies" />
                </figure>
                <div class="card-body items-center text-center">
                    <h5 class="card-title">Tasty brownies</h5>
                </div>
            </a>
            <a class="card bg-base-300 w-70 shadow-sm cursor-pointer rounded-4xl" href="#">
                <div class="card-body items-center text-center">
                    <h1 class="card-title text-2xl font-serif">Cupcakes</h1>
                </div>
                <figure class="h-[210px] w-full overflow-hidden">
                    <img class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                        src="{{ asset('images/cupcake.jpg') }}" alt="cupcake" />
                </figure>
                <div class="card-body items-center text-center">
                    <h5 class="card-title">Sweet cupcakes</h5>
                </div>
            </a>
        </div>
    </div>


    <div
        class="text-base-200 bg-primary text-center text:2xl md:text-5xl h-40 md:h-60 flex items-center justify-center tracking-widest">
        FOLLOW US ON &nbsp;<span class="text-secondary"> INSTAGRAM</span>
    </div>

    <section class="bg-base-300 border-t-2">
        <div class="container mx-auto flex flex-col md:flex-row items-center py-12 px-6">
            <!-- Image Section -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Meet the Artist" class="max-w-full rounded-lg shadow-lg">
            </div>

            <!-- Text Section -->
            <div class="md:w-1/2 text-center md:text-left px-6">
                <div class="flex justify-center md:justify-start mb-2">
                    <i data-lucide="chef-hat" class="text-primary w-8 h-8"></i>
                </div>
                <h2 class="text-primary text-5xl font-bold mb-3">Meet the Artist</h2>
                <p class="text-primary mb-4 leading-relaxed">
                    In 2012, I founded Muniroh’s Bakery in Malaysia as a means to support my family as a student.
                    What began as a necessity soon transformed into a heartfelt hobby and passion...
                </p>
                <a href="#" class="btn btn-secondary">
                    Read more
                </a>
            </div>
        </div>
    </section>


    <div class="text-center py-20 container mx-auto">
        <h1 class="text-5xl font-bold">Welcome to bake corner!</h1>
        <p class="mt-4 text-lg">Enjoy our freshly baked goods made with love. 🍞🥐🎂</p>
        <a href="#menu" class="btn btn-primary mt-6">View Our Menu</a>
    </div>
@endsection
