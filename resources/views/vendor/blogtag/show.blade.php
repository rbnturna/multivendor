<!-- filepath: /c:/xampp/htdocs/multi-vendor/resources/views/vendor/blogtag/show.blade.php -->
@extends('vendor.layouts.app')
@section('title', 'Blog Tag Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Blog Tag Details</h1>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $blogTag->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $blogTag->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $blogTag->slug }}</td>
                </tr>
            </table>
            <a href="{{ route('vendor.blogtag.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection