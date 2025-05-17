@extends('frontend.layout.master')

@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">Privacy Policy</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Privacy Policy Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Privacy Policy</span>
    </h2>
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div class="bg-light p-4">
                <h4>Introduction</h4>
                <p>At our multi-store platform, we value your privacy and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you visit or make a purchase from our website.</p>

                <h4>Information We Collect</h4>
                <p>We collect the following types of information:</p>
                <ul>
                    <li><strong>Personal Information:</strong> Name, email address, phone number, billing and shipping addresses.</li>
                    <li><strong>Payment Information:</strong> Credit/debit card details or other payment methods (processed securely).</li>
                    <li><strong>Account Information:</strong> Username, password, and purchase history.</li>
                    <li><strong>Browsing Data:</strong> IP address, browser type, device information, and browsing behavior.</li>
                </ul>

                <h4>How We Use Your Information</h4>
                <p>Your information is used for the following purposes:</p>
                <ul>
                    <li>To process and fulfill your orders, including shipping and returns.</li>
                    <li>To provide customer support and respond to your inquiries.</li>
                    <li>To send promotional emails, newsletters, and special offers (you can opt-out anytime).</li>
                    <li>To improve our website, products, and services based on user behavior and feedback.</li>
                    <li>To comply with legal obligations and prevent fraudulent activities.</li>
                </ul>

                <h4>Data Security</h4>
                <p>We implement industry-standard security measures to protect your personal information. This includes encryption, secure servers, and regular security audits. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

                <h4>Cookies and Tracking Technologies</h4>
                <p>We use cookies and similar technologies to enhance your browsing experience. Cookies help us remember your preferences, analyze website traffic, and provide personalized recommendations. You can manage your cookie preferences through your browser settings.</p>

                <h4>Third-Party Sharing</h4>
                <p>We do not sell or rent your personal information to third parties. However, we may share your data with trusted partners, such as payment processors, shipping companies, and marketing service providers, to fulfill your orders and improve our services.</p>

                <h4>Your Rights</h4>
                <p>You have the right to:</p>
                <ul>
                    <li>Access, update, or delete your personal information.</li>
                    <li>Opt-out of receiving promotional communications.</li>
                    <li>Request a copy of the data we hold about you.</li>
                </ul>

                <h4>Changes to This Policy</h4>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with the updated date.</p>

                <h4>Contact Us</h4>
                <p>If you have any questions or concerns about our Privacy Policy, please contact us at:</p>
                <p><strong>Email:</strong> info@example.com</p>
                <p><strong>Phone:</strong> +012 345 67890</p>
            </div>
        </div>
    </div>
</div>
<!-- Privacy Policy End -->

@endsection