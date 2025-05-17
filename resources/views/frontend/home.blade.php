@extends('frontend.layout.master')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/img') }}/carousel-1.jpg" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/img') }}/carousel-2.jpg" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/img') }}/carousel-3.jpg" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{ asset('frontend/img') }}/offer-1.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{ asset('frontend/img') }}/offer-2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Categories</span>
    </h2>
    <div class="row px-xl-5 pb-3">
        @foreach ($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="#">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>{{ $category->name }}</h6>
                            <small class="text-body">{{ $category->products_count }} Products</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
<!-- Categories End -->


<!-- Featured Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Featured Products</span>
    </h2>
    <div class="row px-xl-5">
        @foreach ($featuredProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square add-to-cart" href="javascript:void(0);" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square add-to-wishlist" href="javascript:void(0);" data-product-id="{{ $product->id }}"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square add-to-search" href="javascript:void(0)" data-product-keyword="{{ $product->name }}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4" onclick="window.location.href='{{ route('product.detail', ['slug' => $product->slug]) }}'" style="cursor: pointer;">
                        <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${{ $product->selling_price }}</h5>
                            <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <small class="fa {{ $i <= $product->rating ? 'fa-star text-primary' : 'fa-star text-muted' }} mr-1"></small>
                            @endfor
                            <small>({{ $product->total_reviews }})</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Featured Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{ asset('frontend/img') }}/offer-1.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{ asset('frontend/img') }}/offer-2.jpg" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Recent Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Recent Products</span>
    </h2>
    <div class="row px-xl-5">
        @foreach ($recentProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square add-to-cart" href="javascript:void(0);" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square add-to-wishlist" href="javascript:void(0);" data-product-id="{{ $product->id }}"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square add-to-search" href="javascript:void(0)" data-product-keyword="{{ $product->name }}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4" onclick="window.location.href='{{ route('product.detail', ['slug' => $product->slug]) }}'" style="cursor: pointer;">
                        <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${{ $product->selling_price }}</h5>
                            <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <small class="fa {{ $i <= $product->rating ? 'fa-star text-primary' : 'fa-star text-muted' }} mr-1"></small>
                            @endfor
                            <small>({{ $product->total_reviews }})</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Recent Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="{{ asset('frontend/img') }}/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // alert('Hello');
        $('.add-to-search').on('click', function() {
            
            const productKeyword = $(this).data('product-keyword');
            $('#search-input').val(productKeyword);
            $('#search-input').focus(); // Trigger the input event to show results
            $('#search-input').trigger('keyup');
        });
        $('.add-to-wishlist').on('click', function() {
            const productId = $(this).data('product-id');

            $.ajax({
                url: '{{ route('wishlist.add') }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.message) {
                       
                        $('.global-wishlist-count').html(response.total_items);
                        toastr.success(response.message); // Replace with a toast notification for better UX
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });


        // Add to Cart functionality
        $('.add-to-cart').on('click', function() {
            const productId = $(this).data('product-id');

            $.ajax({
                url: '{{ route('cart.add') }}', // Ensure this route is defined in your routes file
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: 1, // Default quantity
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.message) {
                        // Update the cart count (if applicable)
                        // alert(response.total_items);
                        $('.global-cart-count').html(response.total_items);
                        toastr.success(response.message); // Replace with a toast notification for better UX
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    toastr.error('Failed to add product to cart. Please try again.');
                }
            });
        });

       
    });

</script>
@endpush