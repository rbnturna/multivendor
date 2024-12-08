@extends('superAdmin.layouts.app')

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Vendors List</h4>
                    </div>
                    <div>
                        <a href="/superadmin/vendors/create" class="btn btn-primary">Add New Vendor</a>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Manage your vendors efficiently using the table below. Use the action buttons to view, edit, or delete vendors.
                    </p>
                    <div class="custom-datatable-entries">
                        <table
                            id="vendorTable"
                            class="table table-striped"
                            data-toggle="data-table"
                        >
                            <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Subdomain</th>
                                    <th>Domain</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->address }}</td>
                                        <td>{{ $vendor->subdomain }}</td>
                                        <td>{{ $vendor->domain }}</td>
                                        <td>
                                            @if($vendor->status === 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif($vendor->status === 2)
                                                <span class="badge bg-danger">Blocked</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a href="{{ url('/vendors/' . $vendor->id) }}" class="btn btn-info btn-sm">View</a> -->
                                            <a href="{{ route('vendors.edit' , $vendor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm" onclick="deleteVendor('{{ $vendor->id }}')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Registration Date</th>
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
        //     $('#vendorTable').DataTable({
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

        function deleteVendor(vendorId) {
            if (confirm("Are you sure you want to delete this vendor?")) {
                // Replace with your delete endpoint logic
                alert("Vendor " + vendorId + " deleted successfully.");
            }
        }
    </script>
@endpush
