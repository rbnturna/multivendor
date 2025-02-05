@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>
    <form action="{{ route('superadmin.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <textarea class="form-control" id="shipping_address" name="shipping_address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <h4>Order Items</h4>
        <div id="order-items">
            <div class="order-item mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Product</label>
                        <select class="form-select product-select" name="items[0][product_id]" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Variation</label>
                        <select class="form-select variation-select" name="items[0][variation_id]">
                            <option value="">No Variation</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="items[0][quantity]" min="1" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-light btn-sm remove-item-btn mt-5">
                        <i class="bi bi-x-circle remove-item-btn text-danger fs-5"></i>
                        </button>
                    </div>
                   
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-item">Add Item</button>

        <button type="submit" class="btn btn-primary mt-3">Create Order</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 1;

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
            console.log(variationSelect);
            
            fetch(`/vendor/api/products/${productId}/variations`)
                .then(response => response.json())
                .then(data => {
                    variationSelect.innerHTML = '<option value="">No Variation</option>';
                    data.forEach(variation => {
                        variationSelect.innerHTML += `<option value="${variation.id}">${Object.values(variation.attributes).join(", ")}</option>`;
                    });
                });
        }
    });
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item-btn')) {
            console.log(e.target.closest('#order-items').querySelectorAll('div.order-item').length);
            if(e.target.closest('#order-items').querySelectorAll('div.order-item').length>1)
             e.target.closest('.order-item').remove();
        }
    });

});
</script>

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
      $(document).ready(function(){
        $( '#select-field-caterory' ).select2( {
            theme: 'bootstrap-5'
        } );
        $( '#select-field-tags' ).select2( {
            theme: 'bootstrap-5'
        } );
    });
</script>
@endpush