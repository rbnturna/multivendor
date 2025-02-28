@extends('vendor.layouts.app')
@section('title', 'Edit Order Details')

@section('content')
<div class="container">
    <form action="{{ route('vendor.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Order Items Column -->
            <div class="col-md-6 mb-4">
                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Order Items</h4>
                        <div class="d-flex align-items-center gap-2">
                            <a href="javascript:void(0)"
                            id="add-item" 
                            class="btn btn-outline-primary btn-sm"
                            style="border-radius: 20px; padding: 8px 15px;">
                                <i class="fas fa-edit me-1"></i> Add Item 
                            </a>
                            
                            <!-- <form action="{{ route('vendor.orders.update', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <div class="input-group">
                                    <select name="status" class="form-select form-select-sm border-primary" 
                                            style="width: 160px; border-radius: 20px 0 0 20px;">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm" 
                                            style="border-radius: 0 20px 20px 0; padding: 8px 20px;">
                                        Update
                                    </button>
                                </div>
                            </form> -->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class=" list-group list-group-flush" id="order-items">
                            @foreach ($order->items as $index => $item)
                            <li class="list-group-item order-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Product</label>
                                            <select class="form-select product-select" name="items[{{ $index }}][product_id]" required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Variation</label>
                                            <select class="form-select variation-select" name="items[{{ $index }}][variation_id]">
                                                <option value="">No Variation</option>
                                                @if ($item->product->variations)
                                                    @foreach ($item->product->variations as $variation)
                                                        <option value="{{ $variation->id }}" 
                                                            {{ $item->variation_id == $variation->id ? 'selected' : '' }}>
                                                            {{ implode(', ', $variation->attributes) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" class="form-control" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-light btn-sm remove-item-btn mt-5">
                                            <i class="bi bi-x-circle remove-item-btn text-danger fs-5"></i>
                                            </button>
                                        </div>
                                    </div>
                            </li>
                            @endforeach
                            <!-- <li class="list-group-item bg-light">
                                <div class="row fw-bold">
                                    <div class="col-8">Total Price:</div>
                                    <div class="col-4 text-end">${{ number_format($order->total_price, 2) }}</div>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Order Details Column -->
            <div class="col-md-6">
                <div class="card">
                    
                    <div class="card-body">
                    <h5 class="card-title">Order Information</h5>
                        <div class="row">
                            <div class=" col-md-12 mb-3">
                                <label for="shipping_address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="shipping_address" name="shipping_address" required>{{ $order->shipping_address }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="credit_card" {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="paypal" {{ $order->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Order Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Card for Payment/Status Info -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Customer Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" id="name" name="name" value='{{ $order->name }}'/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" id="email" name="email" value='{{ $order->email }}' />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input class="form-control" id="phone" name="phone" required value="{{ $order->phone }}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="additional_phone" class="form-label">Additional Phone</label>
                                <input class="form-control" id="additional_phone" name="additional_phone" value='{{ $order->additional_phone }}' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = {{ count($order->items) }};

    document.getElementById('add-item').addEventListener('click', function () {
        const orderItems = document.getElementById('order-items');
        const newItem = document.querySelector('.order-item').cloneNode(true);

        newItem.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace(/\d+/, itemIndex);
            input.value = '';
        });

        orderItems.appendChild(newItem);
        itemIndex++;
    });

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('product-select')) {
            const productId = e.target.value;
            const variationSelect = e.target.closest('.order-item').querySelector('.variation-select');

            fetch(`/api/products/${productId}/variations`)
                .then(response => response.json())
                .then(data => {
                    variationSelect.innerHTML = '<option value="">No Variation</option>';
                    data.forEach(variation => {
                        variationSelect.innerHTML += `<option value="${variation.id}">${variation.attributes.join(', ')}</option>`;
                    });
                });
        }
    });
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item-btn')) {
            console.log(e.target.closest('#order-items').querySelectorAll('li.order-item').length);
            if(e.target.closest('#order-items').querySelectorAll('li.order-item').length>1)
            if(confirm('Are you really want to remove this item from order list'))
             e.target.closest('.order-item').remove();
        }
    });
});
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
    $(document).ready(function(){
        $( '#select-field-caterory' ).select2( {
            theme: 'bootstrap-5'
        } );
        $( '#select-field-tags' ).select2( {
            theme: 'bootstrap-5'
        } );
    });
    // function deleteproduct(productId) {
    //     if (confirm("Are you sure you want to delete this Variant?")) {
    //         // Replace with your delete endpoint logic

    //         $.ajax({
    //             url: "{{ route('vendor.products.variations.destroy', '') }}/" + productId, // Add variation ID to the URL
    //             type: "DELETE",
    //             data: {
    //                 _token: "{{ csrf_token() }}" // Pass the CSRF token
    //             },
    //             success: function(response) {
    //                 console.log(response);
                    
    //                     alert(response);
    //                     // Optionally remove the deleted row or refresh the table
    //                     $("#variation-row-" + productId).remove();
    //                 // } else {
    //                 //     alert("Failed to delete the variation. Please try again.");
    //                 // }
    //             },
    //             error: function(xhr) {
    //                 alert("An error occurred: " + xhr.responseText);
    //             }
    //         });
    //         // alert("Variant " + productId + " deleted successfully.");
    //     }
    // }
</script>

<!-- Add any necessary scripts here -->
@endpush