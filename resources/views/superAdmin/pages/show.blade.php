@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    <div class="content">
        {!! $processedContent !!}
    </div>
</div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush