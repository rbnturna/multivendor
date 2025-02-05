@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>Product Variations</h1>
    <a href="{{ route('superadmin.variations.create') }}" class="btn btn-primary">Create Variation</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Product</th>
                <th>Attributes</th>
                <th>Price</th>
                <th>Sale Price</th>
                <th>Stock</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                @foreach($product->variations as $variation)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td> @foreach($variation->attributes as $k=>$v)
                            <span class="badge bg-secondary">{{$k}}:{{$v}}</span>
                            @endforeach </td>
                        <td>{{ $variation->price }}</td>
                        <td>{{ $variation->sale_price ?? 'N/A' }}</td>
                        <td>{{ $variation->stock_quantity }}</td>
                        <td>
                            @if($variation->image)
                                <img src="{{ asset('storage/' . $variation->image) }}" alt="Variation Image" style="width: 50px; height: 50px;">
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <h2>Attributes</h2>
    <a href="{{ route('superadmin.attributes.create') }}" class="btn btn-primary">Create Attribute</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Values</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->name }}</td>
                    <td>@foreach($attribute->values as $value)
                            <span class="badge bg-secondary">{{ $value->value }}</span>
                        @endforeach</td>
                    <td>
                        <a href="{{ route('superadmin.attributes.edit', $attribute) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('superadmin.attributes.destroy', $attribute) }}" method="POST" style="display: inline;">
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
