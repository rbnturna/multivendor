@extends('superadmin.layouts.app')

@section('content')
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <form action="{{ route('superadmin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">


                <div class="col-xl-8 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Blogs</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="title">Title:
                                        </label>

                                        <input
                                            name="title"
                                            value="{{$blog->name}}"
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror "
                                            id="title"
                                            placeholder="Blog Title" />
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="slug">Slug:
                                        </label>

                                        <input
                                            name="slug"
                                            value="{{$blog->slug}}"
                                            type="text"
                                            class="form-control @error('slug') is-invalid @enderror "
                                            id="slug"
                                            placeholder="Slug" />
                                        @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="short_description">Short Description:</label>
                                        <textarea
                                            name="short_description"
                                            type="text"
                                            maxlength="200"
                                            rows="4" cols="50"
                                            class="form-control @error('short_description') is-invalid @enderror"
                                            id="short_description"
                                            placeholder="Short description">{{$blog->short_description}}</textarea>
                                        @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="description">Description:</label>
                                        <textarea
                                            name="description"
                                            type="text"
                                            rows="4" cols="50"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description"
                                            placeholder="Description">{{$blog->description}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr />


                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-xl-4 col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add New Blogs</h4>
                            </div>
                        </div>
                        <img
                            src="{{asset('storage/'.$blog->image)}}"
                            alt="profile-pic"
                            class="theme-color-default-img profile-pic rounded avatar-100 m-auto bg-light" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image" class="form-label">Blog Image:</label>
                                <div class="form-group">
                                    <input
                                        type="file"
                                        name="image"
                                        id="image"
                                        class="form-control"
                                        accept="image/*" />
                                </div>

                                <!-- Gallery Images Upload -->


                            </div>
                            <div class="form-group">
                                <label class="form-label">Blog Categories:</label>
                                <select name="categories[]" id="select-field-caterory" multiple class=" form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($blog) && $blog->categories->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Blog Tags:</label>
                                <select name="tags[]" id="select-field-tags" multiple class=" form-control">
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ isset($blog) && $blog->tags->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-4">
                    <button type="submit" class="btn btn-lg btn-primary mb-2">Submit</button>
                </div>

            </div>
        </form>
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
    $(document).ready(function() {
        $('#select-field-caterory').select2({
            theme: 'bootstrap-5'
        });
        $('#select-field-tags').select2({
            theme: 'bootstrap-5'
        });
    });

    // function deleteproduct(productId) {
    //     if (confirm("Are you sure you want to delete this Variant?")) {
    //         // Replace with your delete endpoint logic

    //         $.ajax({
    //             url: "{{ route('superadmin.products.variations.destroy', '') }}/" + productId, // Add variation ID to the URL
    //             type: "DELETE",
    //             data: {
    //                 _token: "{{ csrf_token() }}" // Pass the CSRF token
    //             },
    //             success: function(response) {
    //                 console.log(response);

    //                 alert(response);
    //                 // Optionally remove the deleted row or refresh the table
    //                 $("#variation-row-" + productId).remove();
    //                 // } else {
    //                 //     alert("Failed to delete the variation. Please try again.");
    //                 // }
    //             },
    //             error: function(xhr) {
    //                 alert("An error occurred: " + xhr.responseText);
    //             }
    //         });
    //         // alert("Variant " + productId + " deleted successfully.");
    //     }
    // }
</script>
@endpush