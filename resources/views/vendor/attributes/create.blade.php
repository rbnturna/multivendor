@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Create Attribute</h1>
    <form action="{{ route('vendor.attributes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Attribute Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="values" class="form-label">Attribute Values</label>
            <input type="text" name="values[]" class="form-control mb-2" required placeholder="Value 1">
            <input type="text" name="values[]" class="form-control mb-2" required placeholder="Value 2">
            <button type="button" class="btn btn-secondary add-value">Add More</button>
        </div>

        <button type="submit" class="btn btn-primary">Create Attribute</button>
    </form>
</div>

<script>
document.querySelector('.add-value').addEventListener('click', function () {
    const container = document.querySelector('[for="values"]');
    const newValue = document.createElement('input');
    newValue.type = 'text';
    newValue.name = 'values[]';
    newValue.className = 'form-control mb-2';
    newValue.placeholder = `Value ${document.querySelectorAll('[name="values[]"]').length + 1}`;
    container.appendChild(newValue);
});
</script>
@endsection
