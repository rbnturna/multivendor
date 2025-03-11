@extends('vendor.layouts.app')
@section('title', 'Blog Categories')
@section('content')
<div class="container">
    <!-- <h1 class="mb-4">Blog Categories</h1> -->
    <a href="{{ route('vendor.blogcategories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" style="width: 100px; height: auto;"></td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('vendor.blogcategories.show', $category->id) }}" class="btn btn-success btn-sm">Show</a>
                    <a href="{{ route('vendor.blogcategories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('vendor.blogcategories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection