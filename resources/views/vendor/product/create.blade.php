@extends('vendor.layouts.app')

@section('content')
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">


                <div class="col-xl-8 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">New Product Information</h4>
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
                                            placeholder="Short description"></textarea>
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
                                            placeholder="Description"></textarea>
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
                                <h4 class="card-title">Add New Products</h4>
                            </div>
                        </div>
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
                                        required />
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
                                <select
                                    name="category"
                                    class="selectpicker form-control"
                                    data-style="py-0"
                                    required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing & Apparel</option>
                                    <option value="home_kitchen">Home & Kitchen</option>
                                    <option value="beauty">Beauty & Personal Care</option>
                                    <option value="books_stationery">Books & Stationery</option>
                                    <option value="sports">Sports & Outdoor</option>
                                    <option value="toys">Toys & Games</option>
                                    <option value="health">Health & Wellness</option>
                                    <option value="automotive">Automotive</option>
                                    <option value="groceries">Groceries & Essentials</option>
                                    <option value="jewelry">Jewelry</option>
                                    <option value="digital">Digital Products</option>
                                    <option value="pet_supplies">Pet Supplies</option>
                                    <option value="gifts">Gifts & Occasions</option>
                                    <option value="art_collectibles">Art & Collectibles</option>
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

@endpush