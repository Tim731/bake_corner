//failed.blade.php
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Failed</div>

                    <div class="card-body">
                        <p>Your order has failed.</p>
                        <p>Order ID: {{ $order->order_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
