@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">Terms & Conditions</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Terms & Conditions Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Terms & Conditions</span>
    </h2>
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div class="bg-light p-4">
                <h4>Introduction</h4>
                <p>Welcome to our multi-store platform. By accessing or using our website, you agree to comply with these Terms & Conditions. Please read them carefully before making a purchase or using our services.</p>

                <h4>Eligibility</h4>
                <p>You must be at least 18 years old to use our website. By using our services, you confirm that you meet this requirement.</p>

                <h4>Account Registration</h4>
                <p>To make a purchase, you may need to create an account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>

                <h4>Orders and Payments</h4>
                <ul>
                    <li>All orders are subject to availability and confirmation of payment.</li>
                    <li>Prices are subject to change without notice, but changes will not affect orders that have already been placed.</li>
                    <li>We reserve the right to cancel or refuse any order at our discretion.</li>
                </ul>

                <h4>Shipping and Delivery</h4>
                <p>We aim to deliver your orders within the estimated timeframe. However, delays may occur due to unforeseen circumstances. Shipping costs and policies are outlined during checkout.</p>

                <h4>Returns and Refunds</h4>
                <p>We offer a 14-day return policy for eligible products. Items must be returned in their original condition with proof of purchase. Refunds will be processed within 7-10 business days after receiving the returned item.</p>

                <h4>Intellectual Property</h4>
                <p>All content on this website, including images, text, logos, and designs, is the property of our multi-store platform and is protected by copyright laws. Unauthorized use of our content is strictly prohibited.</p>

                <h4>Prohibited Activities</h4>
                <p>You agree not to:</p>
                <ul>
                    <li>Use our website for illegal or unauthorized purposes.</li>
                    <li>Disrupt or interfere with the security or functionality of our website.</li>
                    <li>Engage in fraudulent activities or provide false information.</li>
                </ul>

                <h4>Limitation of Liability</h4>
                <p>We are not liable for any indirect, incidental, or consequential damages arising from the use of our website or services. Our liability is limited to the maximum extent permitted by law.</p>

                <h4>Governing Law</h4>
                <p>These Terms & Conditions are governed by the laws of [Your Country/State]. Any disputes will be resolved in the courts of [Your Jurisdiction].</p>

                <h4>Contact Us</h4>
                <p>If you have any questions about these Terms & Conditions, please contact us at:</p>
                <p><strong>Email:</strong> info@example.com</p>
                <p><strong>Phone:</strong> +012 345 67890</p>
            </div>
        </div>
    </div>
</div>
<!-- Terms & Conditions End -->

@endsection