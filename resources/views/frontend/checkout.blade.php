@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ url('/product') }}">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- All errors code  -->
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <h5 class="text-danger">Please fix the following errors:</h5>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- end All errors code  -->

<!-- Checkout Start -->
<div class="container-fluid">
    <form action="{{ route('checkout') }}" id="payment-form" method="POST">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                        @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John" required>
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe" required>
                            @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="+123 456 789" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" name="address1" value="{{ old('address1') }}" placeholder="123 Street" required>
                            @error('address1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" name="address2" value="{{ old('address2') }}" placeholder="123 Street">
                            @error('address2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" name="country" value="{{ old('country') }}" placeholder="United States" required>
                            @error('country')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" value="{{ old('city') }}" placeholder="New York" required>
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" name="state" value="{{ old('state') }}" placeholder="New York" required>
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" name="zip" value="{{ old('zip') }}" placeholder="123" required>
                            @error('zip')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount" value="1" name="create_account" {{ old('create_account') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="newaccount" data-toggle="collapse" data-target="#account-password">Create an account</label>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="collapse mb-5" id="account-password">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" value="" name="password" placeholder="Password" autocomplete="new-password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto" name="ship_to_different_address" {{ old('ship_to_different_address') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mb-5" id="shipping-address">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                        <div class="bg-light p-30">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="shipping_first_name" value="{{ old('shipping_first_name') }}" placeholder="John">
                                    @error('shipping_first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="shipping_last_name" value="{{ old('shipping_last_name') }}" placeholder="Doe">
                                    @error('shipping_last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="email" name="shipping_email" value="{{ old('shipping_email') }}" placeholder="example@email.com">
                                    @error('shipping_email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" name="shipping_phone" value="{{ old('shipping_phone') }}" placeholder="+123 456 789">
                                    @error('shipping_phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 1</label>
                                    <input class="form-control" type="text" name="shipping_address1" value="{{ old('shipping_address1') }}" placeholder="123 Street">
                                    @error('shipping_address1')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 2</label>
                                    <input class="form-control" type="text" name="shipping_address2" value="{{ old('shipping_address2') }}" placeholder="123 Street">
                                    @error('shipping_address2')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <input class="form-control" type="text" name="shipping_country" value="{{ old('shipping_country') }}" placeholder="United States">
                                    @error('shipping_country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text" name="shipping_city" value="{{ old('shipping_city') }}" placeholder="New York">
                                    @error('shipping_city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input class="form-control" type="text" name="shipping_state" value="{{ old('shipping_state') }}" placeholder="New York">
                                    @error('shipping_state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" name="shipping_zip" value="{{ old('shipping_zip') }}" placeholder="123">
                                    @error('shipping_zip')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-4">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @foreach($cartItems as $item)
                            <div class="d-flex justify-content-between">
                                <p>{{ $item->product->name }} @if($item->variation) ({{ implode(', ', $item->variation->attributes) }}) @endif</p>
                                <p>${{ ($item->variation ? $item->variation->price : $item->product->price) * $item->quantity }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ $subtotal }}</h6>
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
                    </div>
                </div>
            <!-- </div>
            <div class="col-lg-4"> -->
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="stripe" name="payment_method" value="stripe">
                                <label class="custom-control-label" for="stripe">Stripe</label>
                            </div>
                            <div id="stripe-card-element" class="mt-3">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <div id="stripe-card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="razorpay" id="razorpay" required>
                                <label class="custom-control-label" for="razorpay">Google Pay</label>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="directcheck" id="directcheck" required>
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div> -->
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="banktransfer" id="banktransfer" required>
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form >

</div>
<!-- Checkout End -->

@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
<script src="https://js.stripe.com/v3/"></script>
<script>
    alert('Please fill in the billing address and payment information to proceed with your order.');
    // Initialize Stripe
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling for the card Element
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element
    var card = elements.create('card', { style: style });

    // Mount the card Element into the `#stripe-card-element` div
    card.mount('#stripe-card-element');

    // Handle real-time validation errors from the card Element
    card.on('change', function(event) {
        var displayError = document.getElementById('stripe-card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (selectedPaymentMethod && selectedPaymentMethod.value === 'stripe') {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display error message
                    var errorElement = document.getElementById('stripe-card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        }
    });

    // Submit the form with the Stripe token
    function stripeTokenHandler(token) {
        // Insert the token ID into the form
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>



<script>
    // Razorpay Payment Integration
    
    var form = document.getElementById('payment-form');
    console.log('ddd');
    
    var razorpayOptions = {
        key: "{{ env('RAZORPAY_KEY') }}", // Razorpay API Key
        amount: {{ $total * 100 }}, // Amount in paise
        currency: "INR",
        name: "Your Store Name",
        description: "Order Payment",
        image: "{{ asset('path/to/your/logo.png') }}", // Optional: Add your logo
        handler: function (response) {
            // Handle successful payment
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'razorpay_payment_id');
            hiddenInput.setAttribute('value', response.razorpay_payment_id);
            form.appendChild(hiddenInput);
            form.submit();
        },
        prefill: {
            name: "{{ auth()->user()->name ?? '' }}",
            email: "{{ auth()->user()->email ?? '' }}",
            contact: "{{ auth()->user()->phone ?? '' }}"
        },
        theme: {
            color: "#3399cc"
        }
    };

    var razorpay = new Razorpay(razorpayOptions);

    // Handle form submission
    form.addEventListener('submit', function (event) {
        console.log('form submitted');
        
        var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (selectedPaymentMethod && selectedPaymentMethod.value === 'razorpay') {
            event.preventDefault();
            razorpay.open();
        }
    });
</script>
@endpush