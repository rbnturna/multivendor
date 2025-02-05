@extends('vendor.layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Order Details</h1>

    <div class="mb-3">
        <strong>Shipping Address:</strong> {{ $order->shipping_address }}
    </div>
    <div class="mb-3">
        <strong>Payment Method:</strong> {{ $order->payment_method }}
    </div>
    <div class="mb-3">
        <strong>Status:</strong> {{ $order->status }}
    </div>

    <h3 class="mt-4">Items</h3>
    <ul class="list-group">
        @foreach ($order->items as $item)
            <li class="list-group-item">
                {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('vendor.affiliate.orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection

@push('styles')
<!-- <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
    </style> -->
@endpush

@push('scripts')
<script>
    // $(document).ready(function () {
    //     $('#productTable').DataTable({
    //         // DataTables initialization options
    //         responsive: true,
    //         autoWidth: false,
    //         lengthChange: true,
    //         pageLength: 10,
    //         ordering: true,
    //         columnDefs: [
    //             { orderable: false, targets: [6] } // Disable ordering for Actions column
    //         ]
    //     });
    // });

    function deleteproduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Replace with your delete endpoint logic
            alert("product " + productId + " deleted successfully.");
        }
    }
</script>
@endpush