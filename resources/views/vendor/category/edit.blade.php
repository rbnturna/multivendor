@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('vendor.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="{{ auth()->user()->id }}" {{ $category->parent_id == auth()->user()->id ? 'selected' : '' }}>
                    {{ auth()->user()->name }} (You)
                </option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="name">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control" 
                value="{{ $category->name }}" 
                required
            >
        </div>
        
        <div class="form-group">
            <label for="slug">Slug</label>
            <input 
                type="text" 
                name="slug" 
                id="slug" 
                class="form-control" 
                value="{{ $category->slug }}"
            >
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control"
            >{{ $category->description }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Image</label>
            @if($category->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" style="width: 100px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
