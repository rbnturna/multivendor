@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Tags</h1>
    <a href="{{ route('vendor.tags.create') }}" class="btn btn-primary">Add Tag</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('vendor.tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('vendor.tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
