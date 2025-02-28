@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Details #{{ $order->id }}</h1>
    
    <div class="row">
        <!-- Order Items Column -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Order Items</h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($order->items as $item)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="mb-1">
                                        {{ $item->variation ? $item->variation->product->name : $item->product->name }}
                                    </h6>
                                    @if($item->variation)
                                    <small class="text-muted">
                                        Variation: {{ implode(', ', $item->variation->attributes) }}
                                    </small>
                                    @endif
                                </div>
                                <div class="col-4 text-end">
                                    <div class="text-muted">x{{ $item->quantity }}</div>
                                    <div>${{ number_format($item->price, 2) }}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        <li class="list-group-item bg-light">
                            <div class="row fw-bold">
                                <div class="col-8">Total Price:</div>
                                <div class="col-4 text-end">${{ number_format($order->total_price, 2) }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Order Details Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Order Information</h4>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Order Status:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-primary">{{ ucwords($order->status) }}</span>
                        </dd>

                        <dt class="col-sm-5">Payment Method:</dt>
                        <dd class="col-sm-7">{{ ucfirst($order->payment_method) }}</dd>

                        <dt class="col-sm-5">Shipping Address:</dt>
                        <dd class="col-sm-7">{{ $order->shipping_address }}</dd>

                        <dt class="col-sm-5">Order Date:</dt>
                        <dd class="col-sm-7">{{ $order->created_at->format('M j, Y g:i A') }}</dd>

                        <dt class="col-sm-5">Last Updated:</dt>
                        <dd class="col-sm-7">{{ $order->updated_at->format('M j, Y g:i A') }}</dd>
                    </dl>
                </div>
            </div>

            <!-- Additional Card for Payment/Status Info -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Additional Information</h5>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Customer Name:</small>
                            <p class="mb-0">{{ $order->name??'N/A' }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Contact Email:</small>
                            <p class="mb-0">{{ $order->email??'N/A' }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Contact No:</small>
                            <p class="mb-0">{{ $order->phone??'N/A' }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Additional Contact No:</small>
                            <p class="mb-0">{{ $order->phone??'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    .list-group-item {
        padding: 1.25rem;
        border-color: rgba(0,0,0,0.125);
    }
    dt {
        font-weight: 500;
    }
    dd {
        margin-bottom: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<!-- Add any necessary scripts here -->
@endpush