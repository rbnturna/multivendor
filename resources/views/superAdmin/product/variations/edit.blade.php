@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product Variation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.products.variations.update', [$id, $variation->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $variation->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="sale_price" class="form-label">Sale Price</label>
            <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ old('sale_price', $variation->sale_price) }}">
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ old('stock_quantity', $variation->stock_quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Variation Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($variation->image)
                <img src="{{ asset('storage/' . $variation->image) }}" alt="Variation Image" class="mt-3" width="150">
            @endif
        </div>

        <div class="mb-3">
            <label for="attributes" class="form-label">Attributes</label>
            @foreach($attributes as $attribute)
                <div class="mb-2">
                    <label>{{ $attribute->name }}</label>
                    <select name="attributes[{{ $attribute->name }}]" class="form-select">
                        <option value="">Select Varient</option>

                        @foreach($attribute->values as $value)
                            <option value="{{ $value->value }}" {{ old('attributes.' . $attribute->name, $variation->attributes[$attribute->name] ?? '') == $value->value ? 'selected' : '' }}>
                                {{ $value->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Update Variation</button>
    </form>
</div>
@endsection
