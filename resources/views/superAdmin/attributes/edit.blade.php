@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Attribute</h1>
    <form action="{{ route('superadmin.attributes.update', $attribute->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $attribute->name }}" required>
        </div>

        <div class="mb-3">
            <label for="values" class="form-label">Attribute Values</label>
            <div id="value-container">
                @foreach($attribute->values as $index => $value)
                    <input type="text" name="values[]" class="form-control mb-2" value="{{ $value->value }}" required placeholder="Value {{ $index + 1 }}">
                @endforeach
            </div>
            <button type="button" id="add-value" class="btn btn-secondary">Add More</button>
        </div>

        <button type="submit" class="btn btn-success">Update Attribute</button>
    </form>
</div>

<script>
document.getElementById('add-value').addEventListener('click', function () {
    const container = document.getElementById('value-container');
    const inputCount = container.querySelectorAll('input').length + 1;
    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'values[]';
    newInput.className = 'form-control mb-2';
    newInput.placeholder = `Value ${inputCount}`;
    container.appendChild(newInput);
});
</script>
@endsection
