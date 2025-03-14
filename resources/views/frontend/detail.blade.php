@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ url('/product') }}">Shop</a>
                <span class="breadcrumb-item active">{{ $product->name }}</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="Image">
                    </div>
                    @foreach($product->gallery_images as $image)
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$image) }}" alt="Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $product->name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $product->rating)
                                <small class="fas fa-star"></small>
                            @else
                                <small class="far fa-star"></small>
                            @endif
                        @endfor
                    </div>
                    <small class="pt-1">({{ $product->total_reviews }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">${{ $product->selling_price }}</h3>
                <p class="mb-4">{{ $product->short_description }}</p>

                <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="d-flex mb-3 w-100">
                        <div class="mr-3 w-50">
                            <label>Variations</label>
                            <ul class="list-group w-100">
                                @if ($product->variations)
                                    @foreach ($product->variations as $variation)
                                        <li class="list-group-item d-flex align-items-center">
                                            <div class="d-flex align-items-center w-100">
                                                @if(!empty($variation->image))<img height="20px" src="{{ asset('storage/'.$variation->image) }}" class="mr-2"> @endif
                                                {{ implode(', ', $variation->attributes) }}
                                                <div class="ml-auto d-flex align-items-center">
                                                    <input type="radio" name="variation_id" value="{{ $variation->id }}" class="form-check-input variation-checkbox" style="width: 1.5em; height: 1.5em; margin-bottom: 2px;">
                                                </div>
                                            </div>
                                        </li> 
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <a  href="javascript:void(0)" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus "></i>
                                </a>
                            </div>
                            <input type="text" name="quantity" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <a href="javascript:void(0)" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus "></i>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>

                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            {!! $product->description !!}   
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- Product Detail End -->

<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
       
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/'.$relatedProduct->image) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.detail', $relatedProduct->slug) }}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('product.detail', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${{ $relatedProduct->selling_price }}</h5><h6 class="text-muted ml-2"><del>${{ $relatedProduct->price }}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $relatedProduct->rating)
                                        <small class="fas fa-star text-primary"></small>
                                    @else
                                        <small class="far fa-star text-primary"></small>
                                    @endif
                                @endfor
                                <small>({{ $relatedProduct->total_reviews }})</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

@endsection

@push('scripts')
<script>
    // Quantity buttons functionality
    $(document).ready(function() {
        $('.btn-plus, .btn-minus').on('click', function(e) {
            const isPositive = $(this).hasClass('btn-plus');
            const input = $(this).closest('.quantity').find('input');
            if (isPositive) {
                input.val(parseInt(input.val()) + 1);
            } else if (input.val() > 1) {
                input.val(parseInt(input.val()) - 1);
            }
        });
    });
   

    // Add to cart form submission
    $('#add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                alert(response.message);
            },
            error: function(response) {
                alert('An error occurred. Please try again.');
            }
        });
    });
</script>
@endpush