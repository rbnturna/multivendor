@extends('vendor.layouts.app')
@section('title', 'Blogs List')

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Blogs List</h4>
                    </div>
                    <div>
                        <a href="{{route('vendor.blogs.create')}}" class="btn btn-primary">Add New Blogs</a>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Manage your products efficiently using the table below. Use the action buttons to view, edit, or delete products.
                    </p>
                    <div class="custom-datatable-entries">
                        <table
                            id="tagsTable"
                            class="table table-striped"
                            data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>
                                    <td><img src="{{ asset('storage/'.$blog->image) }}" alt=""></td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if($blog->is_active === 1)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <!-- <a href="{{ url('/products/' . $blog->id) }}" class="btn btn-info btn-sm">View</a> -->
                                        <a href="{{ route('vendor.blogs.edit' , $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteproduct('{{ $blog->id }}')">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
    </style> -->
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