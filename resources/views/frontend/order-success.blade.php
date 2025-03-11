@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ url('/product') }}">Shop</a>
                <span class="breadcrumb-item active">Order Success</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Order Success Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-lg-2 text-center">
            <div class="bg-light p-5 mb-5">
                <h1 class="display-4">Thank You!</h1>
                <h4 class="mb-4">Your order has been placed successfully.</h4>
                <p class="mb-4">Order ID: <strong>{{ $order->id }}</strong></p>
                <p class="mb-4">We appreciate your business! If you have any questions, please email <a href="mailto:support@example.com">support@example.com</a>.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
            <div class="bg-light p-5 mb-5">
                <h4 class="mb-4">Order Details</h4>
                <p><strong>Billing Address:</strong></p>
                <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                <p>{{ $order->address1 }}</p>
                @if($order->address2)
                    <p>{{ $order->address2 }}</p>
                @endif
                <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
                <p>{{ $order->country }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>

                @if($order->shipping_first_name)
                    <h4 class="mt-4 mb-4">Shipping Address</h4>
                    <p>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
                    <p>{{ $order->shipping_address1 }}</p>
                    @if($order->shipping_address2)
                        <p>{{ $order->shipping_address2 }}</p>
                    @endif
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                    <p>{{ $order->shipping_country }}</p>
                    <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                @endif

                <h4 class="mt-4 mb-4">Order Items</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }} @if($item->variation) ({{ implode(', ', $item->variation->attributes) }}) @endif</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ $item->price }}</td>
                                <td>${{ $item->price * $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4 class="mt-4 mb-4">Order Summary</h4>
                <p><strong>Subtotal:</strong> ${{ $order->subtotal }}</p>
                <p><strong>Discount:</strong> -${{ $order->discount }}</p>
                <p><strong>Shipping Cost:</strong> ${{ $order->shipping_cost }}</p>
                <p><strong>Total:</strong> ${{ $order->total }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Order Success End -->

@endsection