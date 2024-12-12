@extends('vendor.layouts.app')

@section('content')
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">


                <div class="col-xl-8 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Product</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="new-user-info">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="name">Name:
                                        </label>

                                        <input
                                            name="name"
                                            value="{{$product->name}}"
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror "
                                            id="name"
                                            placeholder="Product Name" />
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="slug">Slug:
                                        </label>

                                        <input
                                            name="slug"
                                            value="{{$product->slug}}"
                                            type="text"
                                            class="form-control @error('slug') is-invalid @enderror "
                                            id="slug"
                                            placeholder="Slug" />
                                        @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="price">Price:</label>
                                        <input
                                            name="price"
                                            type="text"
                                            value="{{$product->price}}"
                                            class="form-control @error('price') is-invalid @enderror"
                                            id="price"
                                            placeholder="Price" />
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="selling_price">Selling Price:</label>
                                        <input
                                            name="selling_price"
                                            value="{{$product->selling_price}}"
                                            type="text"
                                            class="form-control @error('selling_price') is-invalid @enderror"
                                            id="selling_price"
                                            placeholder="Selling Price" />
                                        @error('selling_price')
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
                                            placeholder="Short description">{{$product->short_description}}</textarea>
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
                                            placeholder="Description">{{$product->description}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr />


                            </div>
                        </div>
                    </div>
                
                    <!--  -->
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title">Product Variation</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                     <a href="{{ route('vendor.products.variations.create',$product->id) }}" class="btn btn-primary float-end">Create Variation</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <table class="table table-sm mt-4">
                                    <thead>
                                        <tr>
                                            <!-- <th>Product</th> -->
                                            <th>Image</th>

                                            <th>Attributes</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->variations as $variation)
                                    
                                        
                                            <tr id="variation-row-{{$variation->id}}">
                                                <!-- <td>{{ $product->name }}</td> -->
                                                <td>
                                                    @if($variation->image)
                                                        <img src="{{ asset('storage/' . $variation->image) }}" alt="Variation Image" style="width: 50px; height: 50px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach($variation->attributes as $k=>$v)
                                                        <span class="badge bg-primary p-1">{{$k}}:{{$v}}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $variation->price }}</td>
                                                <td>{{ $variation->sale_price ?? 'N/A' }}</td>
                                                <td>{{ $variation->stock_quantity }}</td>
                                                
                                                <td>
                                                    <a href="{{route('vendor.products.variations.edit', [$product->id, $variation->id]) }}" class="btn btn-light btn-sm"><i class="bi bi-pencil-fill text-warning fs-5"></i></a>
                                                    <button class="btn btn-light btn-sm" onclick="deleteproduct('{{ $variation->id }}')"><i class="bi bi-x-circle text-danger fs-5"></i></button>
                                                </td>

                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  -->
                </div>



                <div class="col-xl-4 col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add New Products</h4>
                            </div>
                        </div>
                        <img
                                src="{{asset('storage/'.$product->image)}}"
                                alt="profile-pic"
                                class="theme-color-default-img profile-pic rounded avatar-100 m-auto bg-light"
                                />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image" class="form-label">Product Image:</label>
                                <div class="form-group">
                                    <input
                                        type="file"
                                        name="image"
                                        id="image"
                                        class="form-control"
                                        accept="image/*"
                                         />
                                </div>

                                <!-- Gallery Images Upload -->
                                <label for="gallery_images" class="form-label mt-3">Gallery Images:</label>
                                <div class="form-group">
                                    <input
                                        type="file"
                                        name="gallery_images[]"
                                        id="gallery_images"
                                        class="form-control"
                                        accept="image/*"
                                        multiple />
                                    <small class="form-text text-muted">
                                        You can upload multiple images for the product gallery.
                                    </small>
                                </div>
                                <div class="img-extension mt-3 d-none">
                                    <div class="d-inline-block align-items-center">
                                        <span>Only</span>
                                        <a href="javascript:void();">.jpg</a>
                                        <a href="javascript:void();">.png</a>
                                        <a href="javascript:void();">.jpeg</a>
                                        <span>allowed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product Categories:</label>
                                <select name="categories[]" id="select-field-caterory" multiple  class=" form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($product) && $product->categories->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product Tags:</label>
                                    <select name="tags[]" id="select-field-tags"  multiple class=" form-control">
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ isset($product) && $product->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Featured:</label>
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" name="is_featured" type="checkbox" id="switch2"  {{ isset($product) && $product->is_featured?' checked':''}} />
                                    <label class="form-check-label pl-2" for="switch2">Make Featured Product</label>
                                </div>
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
    $(document).ready(function(){
        $( '#select-field-caterory' ).select2( {
            theme: 'bootstrap-5'
        } );
        $( '#select-field-tags' ).select2( {
            theme: 'bootstrap-5'
        } );
    });
    function deleteproduct(productId) {
        if (confirm("Are you sure you want to delete this Variant?")) {
            // Replace with your delete endpoint logic

            $.ajax({
                url: "{{ route('vendor.products.variations.destroy', '') }}/" + productId, // Add variation ID to the URL
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}" // Pass the CSRF token
                },
                success: function(response) {
                    console.log(response);
                    
                        alert(response);
                        // Optionally remove the deleted row or refresh the table
                        $("#variation-row-" + productId).remove();
                    // } else {
                    //     alert("Failed to delete the variation. Please try again.");
                    // }
                },
                error: function(xhr) {
                    alert("An error occurred: " + xhr.responseText);
                }
            });
            // alert("Variant " + productId + " deleted successfully.");
        }
    }
</script>
@endpush