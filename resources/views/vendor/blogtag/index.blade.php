<!-- filepath: /c:/xampp/htdocs/multi-vendor/resources/views/vendor/blogtag/index.blade.php -->
@extends('vendor.layouts.app')
@section('title', 'Blog Tags')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- <h1>Blog Tags</h1> -->
            <a href="{{ route('vendor.blogtag.create') }}" class="btn btn-primary">Create Tag</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                <a href="{{ route('vendor.blogtag.show', $tag->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('vendor.blogtag.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('vendor.blogtag.destroy', $tag->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection