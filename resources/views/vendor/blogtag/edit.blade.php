@extends('vendor.layouts.app')
@section('title', 'Edit Blog Tag')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Blog Tag</h1>
            <form action="{{ route('vendor.blogtag.update', $blogTag->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $blogTag->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $blogTag->slug }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection