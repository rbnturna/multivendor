@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>Attributes</h1>
    <a href="{{ route('superadmin.attributes.create') }}" class="btn btn-primary mb-3">Create New Attribute</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Values</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>
                        @foreach($attribute->values as $value)
                            <span class="badge bg-secondary">{{ $value->value }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('superadmin.attributes.edit', $attribute->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('superadmin.attributes.destroy', $attribute->id) }}" method="POST" style="display:inline-block;">
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
