@extends('superAdmin.layouts.app')

@section('content')
    <h1>Welcome to the Dashboard</h1>
    <p>This is a sample dashboard with a sidebar and navigation.</p>
@endsection

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        console.log("Dashboard page loaded!");
    </script>
@endpush
