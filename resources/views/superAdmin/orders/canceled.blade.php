@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Canceled Orders</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-warning">No canceled orders found.</div>
    @else
        <table id="ordersTable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Shipping Address</th>
                    <th>Payment Method</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ $order->shipping_address }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td><span class="badge bg-danger">{{ ucfirst($order->status) }}</span></td>
                    <td>
                        <a href="{{ route('superadmin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Shipping Address</th>
                    <th>Payment Method</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    @endif
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