@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-primary">Contact Us</h1>
                <p class="mt-4 text-lg text-gray-600">We'd love to hear from you!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-base-100 rounded-2xl shadow-md p-8">
                    <h2 class="text-3xl font-bold text-primary mb-6">Send us a Message</h2>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name"
                                class="w-full input input-primary"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full input input-primary"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full textarea textarea-primary"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="bg-base-100 rounded-2xl shadow-md p-8">
                    <h2 class="text-3xl font-bold text-primary mb-6">Our Information</h2>
                    <div class="mb-4 flex items-center">
                        <i data-lucide="map-pin" class="text-primary w-6 h-6 mr-4"></i>
                        <p class="text-gray-700">123 Main Street, City, Country</p>
                    </div>
                    <div class="mb-4 flex items-center">
                        <i data-lucide="phone" class="text-primary w-6 h-6 mr-4"></i>
                        <p class="text-gray-700">+1 (555) 123-4567</p>
                    </div>
                    <div class="mb-4 flex items-center">
                        <i data-lucide="mail" class="text-primary w-6 h-6 mr-4"></i>
                        <p class="text-gray-700">info@bakecorner.com</p>
                    </div>
                    <div class="flex items-center">
                        <i data-lucide="clock" class="text-primary w-6 h-6 mr-4"></i>
                        <p class="text-gray-700">Mon - Fri: 9:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
