@extends('vendor.layouts.app')
@section('title', 'Create Blog Category')

@section('content')
    <div class="container mt-5">
        <!-- <h1>Create Blog Category</h1> -->
        <form action="{{ route('vendor.blogcategories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('vendor.blogcategories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    @endsection