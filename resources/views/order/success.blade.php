@section('content')
    <div class="container mx-auto py-12 px-4">
        <h1 class="text-5xl font-bold text-primary text-center mb-8">Order Success</h1>
        <div class="alert alert-success shadow-lg mb-6">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Order placed successfully!</span>
            </div>
        </div>
        <div class="bg-base-100 rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-primary mb-4">Order Details</h2>
            <p>Order ID: {{ $order->id }}</p>
            <p>Total Amount: ₱{{ number_format($order->total_amount, 2) }}</p>
            <p>Payment Method: {{ $order->payment_method }}</p>
            <p>Status: {{ $order->status }}</p>
            <p>Thank you for your order!</p>
        </div>
    </div>
@endsection
