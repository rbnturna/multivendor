@extends('vendor.layouts.app')
@section('title', 'Create Blog Tag')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create Blog Tag</h1>
            <form action="{{ route('vendor.blogtag.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection