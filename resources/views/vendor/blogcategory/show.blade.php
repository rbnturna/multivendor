@extends('vendor.layouts.app')
@section('title', 'Blog Category Details')

@section('content')
    <div class="container mt-5">
        <h1>{{ $blogCategory->name }}</h1>
        <p><strong>Slug:</strong> {{ $blogCategory->slug }}</p>
        <p><strong>Description:</strong> {{ $blogCategory->description }}</p>
        @if($blogCategory->image)
            <img src="{{ asset('storage/' . $blogCategory->image) }}" alt="{{ $blogCategory->name }}" class="img-fluid">
        @endif
        <div class="mt-4">
            <a href="{{ route('vendor.blogcategories.index') }}" class="btn btn-primary">Back to Categories</a>
            <a href="{{ route('vendor.blogcategories.edit', $blogCategory->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('vendor.blogcategories.destroy', $blogCategory->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endsection