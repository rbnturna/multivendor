@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Create Product Variation</h1>
    <form action="{{ route('vendor.products.variations.store',$id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sale_price" class="form-label">Sale Price</label>
            <input type="number" name="sale_price" id="sale_price" class="form-control">
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Variation Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="attributes" class="form-label">Attributes</label>
            @foreach($attributes as $attribute)
                <div class="mb-2">
                    <label>{{ $attribute->name }}</label>
                    <select name="attributes[{{ $attribute->name }}]" class="form-select">
                            <option value="">Select Varient</option>
                        @foreach($attribute->values as $value)
                            <option value="{{ $value->value }}">{{ $value->value }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Create Variation</button>
    </form>
</div>
@endsection
