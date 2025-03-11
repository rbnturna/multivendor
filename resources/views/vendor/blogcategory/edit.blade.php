@extends('vendor.layouts.app')
@section('title', 'Edit Blog Category')

@section('content')
<form action="{{ route('vendor.blogcategories.update', $blogCategory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container mt-5">
        <!-- <h2>Edit Blog Category</h2> -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $blogCategory->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $blogCategory->slug) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $blogCategory->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <img src="{{ asset('storage/'.$blogCategory->image) }}" width="100" alt="{{ $blogCategory->name }}">
            <input type="file" class="form-control" id="image" name="image">
           
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('vendor.blogcategories.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection