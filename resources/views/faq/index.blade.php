@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="bg-base-200">
        <div class="container mx-auto py-12 px-4">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-primary">Frequently Asked Questions</h1>
                <p class="mt-4 text-lg text-gray-600">Find answers to common questions about Bake Corner.</p>
            </div>

            <div class="max-w-3xl mx-auto">
                <!-- FAQ Item 1 -->
                <div class="collapse collapse-arrow bg-base-100 rounded-2xl shadow-md mb-4">
                    <input type="radio" name="my-accordion-2" checked="checked" />
                    <div class="collapse-title text-xl font-medium">
                        What are your hours of operation?
                    </div>
                    <div class="collapse-content">
                        <p>We are open Monday through Friday from 9:00 AM to 5:00 PM.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="collapse collapse-arrow bg-base-100 rounded-2xl shadow-md mb-4">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title text-xl font-medium">
                        Do you offer custom cake designs?
                    </div>
                    <div class="collapse-content">
                        <p>Yes, we love creating custom cake designs! Please contact us to discuss your ideas.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="collapse collapse-arrow bg-base-100 rounded-2xl shadow-md mb-4">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title text-xl font-medium">
                        What ingredients do you use?
                    </div>
                    <div class="collapse-content">
                        <p>We use only the finest ingredients in our baked goods, including fresh, high-quality products.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="collapse collapse-arrow bg-base-100 rounded-2xl shadow-md mb-4">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title text-xl font-medium">
                        How far in advance should I place an order?
                    </div>
                    <div class="collapse-content">
                        <p>We recommend placing your order at least 48 hours in advance, especially for custom cakes.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="collapse collapse-arrow bg-base-100 rounded-2xl shadow-md mb-4">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title text-xl font-medium">
                        Do you offer delivery?
                    </div>
                    <div class="collapse-content">
                        <p>Yes, we offer delivery within a certain radius. Please contact us for more information.</p>
                    </div>
                </div>
                <!-- Add more FAQ items here -->
            </div>
        </div>
    </div>
@endsection
