@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Page</h1>

    <form action="{{ route('vendor.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="hidden" id="content" name="content">
            <div id="quill-editor" style="height: 300px; background-color: #fff;">{!! $page->content !!}</div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($page->image)
                <img src="{{ asset('storage/' . $page->image) }}" alt="Page Image" class="img-thumbnail mt-2" style="max-height: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>


@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
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
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
    });

    document.querySelector('form').onsubmit = function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    };
</script>
@endpush