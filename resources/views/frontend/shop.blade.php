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


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            @foreach ($attributes as $attribute)
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by {{ ucfirst($attribute->name) }}</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <!-- 'All' Option Checkbox -->
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="{{ $attribute->name }}-all">
                        <label class="custom-control-label" for="{{ $attribute->name }}-all">All {{ ucfirst($attribute->name) }}</label>
                        <span class="badge border font-weight-normal">{{ $attribute->values->count() }}</span>
                    </div>

                    <!-- Attribute Values -->
                    @foreach ($attribute->values as $value)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="{{ $attribute->name }}-{{ $value->id }}">
                        <label class="custom-control-label" for="{{ $attribute->name }}-{{ $value->id }}">
                            {{ ucfirst($value->value) }}
                        </label>
                        <span class="badge border font-weight-normal">150</span> <!-- Modify this based on actual logic -->
                    </div>
                    @endforeach
                </form>
            </div>
            @endforeach


        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', ['slug' => $product->slug]) }}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹{{ $product->selling_price }}</h5>
                                @if($product->price > $product->selling_price)
                                <h6 class="text-muted ml-2"><del>₹{{ $product->price }}</del></h6>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <small class="fa fa-star{{ $i <= $product->rating ? ' text-primary' : '-o' }} mr-1"></small>
                                    @endfor
                                    <small>({{ $product->total_reviews }})</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection