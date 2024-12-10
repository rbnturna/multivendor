@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tag</h1>
    <form action="{{ route('vendor.tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $tag->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" value="{{ $tag->slug }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
