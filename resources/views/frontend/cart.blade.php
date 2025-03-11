@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ url('/product') }}">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                <div id="loader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999; text-align: center; padding-top: 20%;">
                    <div class="spinner-border text-primary" role="status" style="width: 8rem; height: 8rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                    @foreach($cartItems as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="align-middle">
                                <img src="{{ $item->product->image }}" alt="" style="width: 50px;">
                                {{ $item->product->name }}
                                @if($item->variation)
                                    <br>
                                    <small>{{ implode(', ', $item->variation->attributes) }}</small>
                                @endif
                            </td>
                            <td class="align-middle">${{ $item->variation ? $item->variation->price : $item->product->price }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity" readonly class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $item->quantity }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle total-price-{{ $item->id }}" data-price="{{ $item->variation ? $item->variation->price : $item->product->price }}">${{ ($item->variation ? $item->variation->price : $item->product->price) * $item->quantity }}</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger btn-remove">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form action="{{ route('cart.applyCoupon') }}" method="POST">
                @csrf
                <div class="input-group mb-4">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code" name="coupon_code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>${{ $subtotal }}</h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Discount</h6>
                        <h6>-${{ $discount }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">${{ $shippingCost }}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>${{ $total }}</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Quantity buttons functionality
        $('.btn-plus, .btn-minus').on('click', function(e) {
            const isPositive = $(this).hasClass('btn-plus');
            const input = $(this).closest('.quantity').find('input');
            let quantity = parseInt(input.val());
            // if (isPositive) {
            //     quantity ++;
            // } else if (quantity > 1) {
            //     quantity --;
            // }
            // input.val(quantity);
            const id = $(this).closest('tr').data('id');
           
            updateCart(id, quantity);
        });

        // Remove button functionality
        $('.btn-remove').on('click', function(e) {
            const row = $(this).closest('tr');
            const id = row.data('id');
            removeFromCart(id, row);
        });

        // Update cart function
        function updateCart(id, quantity) {
            $.ajax({
                url: '{{ route('cart.update', '') }}/' + id,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                beforeSend: function() {
                    // Show loader
                    $('#loader').show();
                },
                success: function(response) {
                    // Hide loader
                    $('#loader').hide();
                    toastr.success(response.message);
                    
                    // Show success message
                    // alert(response.message);
                    // Update cart summary
                    updateCartSummary();

                    const price = parseInt($('.total-price-' + id).data('price'));
                        if(!isNaN(price) && !isNaN(quantity)) {
                            $('.total-price-' + id).text('$' + quantity*price);
                        }
                },
                error: function(response) {
                    // Hide loader
                    $('#loader').hide();
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        // Remove from cart function
        function removeFromCart(id, row) {
            $.ajax({
                url: '{{ route('cart.remove', '') }}/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    // Show loader
                    $('#loader').show();
                },
                success: function(response) {
                    // Hide loader
                    $('#loader').hide();
                    // Show success message
                    toastr.success(response.message);
                    // Remove row from table
                    row.remove();
                    // Update cart summary
                    updateCartSummary();
                },
                error: function(response) {
                    // Hide loader
                    $('#loader').hide();
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        // Update cart summary function
        function updateCartSummary() {
            $.ajax({
                url: '{{ route('cart.show') }}',
                method: 'GET',
                success: function(response) {
                    // Update subtotal, discount, shipping cost, and total
                    $('h6:contains("Subtotal")').next().text('$' + response.subtotal);
                    $('h6:contains("Discount")').next().text('-$' + response.discount);
                    $('h6:contains("Shipping")').next().text('$' + response.shippingCost);
                    $('h5:contains("Total")').next().text('$' + response.total);
                }
            });
        }
    });
</script>
@endpush