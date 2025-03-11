@extends('vendor.layouts.app')
@section('title', 'Create Blog')

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
        <form action="{{ route('vendor.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">


                <div class="col-xl-8 col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">New Blog Information</h4>
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
                                            placeholder="Short description"></textarea>
                                        @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="description">Description:</label>
                                        <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                                        <div id="editor">{!! old('description') !!}</div>
               
                                        <!-- <textarea
                                            name="description"
                                            type="text"
                                            rows="4" cols="50"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description"
                                            placeholder="Description"></textarea> -->
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
                                <h4 class="card-title">Add New blogs</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image" class="form-label">Blog Image:</label>
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
                               
                            </div>
                            <div class="form-group">
                                <label class="form-label">Blog Categories:</label>
                                <select name="categories[]" id="select-field-caterory" multiple  class=" form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($blog) && $blog->blog->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Blog Tags:</label>
                                    <select name="tags[]" id="select-field-tags"  multiple class=" form-control">
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
      $(document).ready(function(){
        $( '#select-field-caterory' ).select2( {
            theme: 'bootstrap-5'
        } );
        $( '#select-field-tags' ).select2( {
            theme: 'bootstrap-5'
        } );
    });
</script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }, { 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ],
            imageResize: {
                displaySize: true
            }
        }
    });

    quill.on('text-change', function() {
        document.getElementById('description').value = quill.root.innerHTML;
    });

    function uploadImage(file) {
        var formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('vendor.blog.upload') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                var range = quill.getSelection();
                quill.insertEmbed(range.index, 'image', result.url);
            }
        });
    }

    quill.getModule('toolbar').addHandler('image', () => {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
            var file = input.files[0];
            if (file) {
                uploadImage(file);
            }
        };
    });
</script>
@endpush