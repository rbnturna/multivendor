@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">Wishlist</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Wishlist Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse($wishlistItems as $item)
                        <tr data-id="{{ $item->id }}">
                            <td>
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $item->product->name }}" style="width: 50px;">
                                {{ $item->product->name }}
                            </td>
                            <td>${{ $item->product->price }}</td>
                            <td>
                                <button class="btn btn-primary move-to-cart">Move to Cart</button>
                                <button class="btn btn-danger remove-from-wishlist">Remove</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Your wishlist is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Wishlist End -->

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.move-to-cart').on('click', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            $.ajax({
                url: '{{ url('wishlist/move-to-cart') }}/' + id,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        row.remove();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });

        $('.remove-from-wishlist').on('click', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            $.ajax({
                url: '{{ url('wishlist/remove') }}/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                    row.remove();
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@endpush