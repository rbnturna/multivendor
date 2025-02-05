@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Pages</h1>
        <a href="{{ route('superadmin.pages.create') }}" class="btn btn-primary">Create New Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>
                    @if($page->image)
                        <img src="{{ asset('storage/' . $page->image) }}" alt="Page Image" class="img-thumbnail" style="max-height: 50px;">
                    @endif
                </td>
                <td>
                    <a href="{{ route('vendor.pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('vendor.pages.destroy', $page->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    // $(document).ready(function () {
    //     $('#productTable').DataTable({
    //         // DataTables initialization options
    //         responsive: true,
    //         autoWidth: false,
    //         lengthChange: true,
    //         pageLength: 10,
    //         ordering: true,
    //         columnDefs: [
    //             { orderable: false, targets: [6] } // Disable ordering for Actions column
    //         ]
    //     });
    // });

    function deleteproduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Replace with your delete endpoint logic
            alert("product " + productId + " deleted successfully.");
        }
    }
</script>
@endpush