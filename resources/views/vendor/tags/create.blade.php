@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Add Tag</h1>
    <form action="{{ route('vendor.tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
