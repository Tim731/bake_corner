@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4">
            {{-- <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-primary">About Bake Corner</h1>
                <p class="mt-4 text-lg text-gray-600">Learn more about our story and our passion for baking.</p>
            </div> --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <img src="{{ asset('images/about_us.jpg') }}" alt="About Us"
                        class="w-full rounded-2xl shadow-lg object-cover h-96">
                </div>
                <div class="order-1 md:order-2">
                    <h2 class="text-3xl font-bold text-primary mb-4">Our Story</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Bake Corner started with a simple dream: to share the joy of homemade baked goods with our
                        community.
                        Founded by [Your Name/Founder's Name], a passionate baker with a love for creating delicious
                        treats,
                        we've grown from a small home kitchen to a beloved local bakery.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        We believe in using only the finest ingredients and traditional baking methods to ensure every
                        bite is
                        a moment of pure delight. Our recipes are inspired by family traditions and a desire to bring
                        people together through the magic of baking.
                    </p>
                </div>
            </div>

            <div class="mt-16">
                <h2 class="text-3xl font-bold text-primary mb-8 text-center">Our Mission</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="target" class="text-primary w-12 h-12 mb-4"></i>
                        <p class="text-gray-700 leading-relaxed text-center">
                            Our mission is to create high-quality, delicious baked goods that bring happiness to our
                            customers.
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="smile" class="text-primary w-12 h-12 mb-4"></i>
                        <p class="text-gray-700 leading-relaxed text-center">
                            We strive to be a welcoming space where everyone can enjoy the simple pleasures of freshly
                            baked treats.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <h2 class="text-3xl font-bold text-primary mb-8 text-center">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="award" class="text-primary w-12 h-12 mb-4"></i>
                        <h3 class="font-bold text-lg mb-2">Quality</h3>
                        <p class="text-gray-700 text-center">We are committed to using the best ingredients and maintaining
                            high standards in our baking.</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="users" class="text-primary w-12 h-12 mb-4"></i>
                        <h3 class="font-bold text-lg mb-2">Community</h3>
                        <p class="text-gray-700 text-center">We value our customers and strive to create a warm and
                            welcoming environment.</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="heart" class="text-primary w-12 h-12 mb-4"></i>
                        <h3 class="font-bold text-lg mb-2">Passion</h3>
                        <p class="text-gray-700 text-center">We are passionate about baking and dedicated to sharing our
                            love for it with others.</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-6 bg-base-100 rounded-2xl shadow-md">
                        <i data-lucide="history" class="text-primary w-12 h-12 mb-4"></i>
                        <h3 class="font-bold text-lg mb-2">Tradition</h3>
                        <p class="text-gray-700 text-center">We honor traditional baking methods while also embracing new
                            ideas and flavors.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="text-center bg-primary py-5 md:py-10 px-4">
        <h2 class="text-3xl font-bold text-base-100 mb-4">Meet the Team</h2>
        <p class="text-base-100 leading-relaxed mb-8">
            We are a small team of dedicated bakers who are passionate about what we do.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-secondary btn-xl">Contact Us</a>
    </div>
@endsection
