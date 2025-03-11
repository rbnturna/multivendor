@extends('frontend.layout.master')

@section('content')

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search..." id="search">
                        </form>
                    </div>
                    <div class="blog__sidebar__item mt-3">
                        <h4>Categories</h4>
                        <ul id="category-filter">
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="#" data-category-id="" class="category-link btn btn-outline-warning btn-block">All Categories</a>
                            </li>
                            @foreach($categories as $category)
                            <li class=" border-bottom p-2">
                                <a href="#" data-category-id="{{ $category->id }}" class="category-link">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image img-thumbnail rounded">
                                    <span class="h6 text-dark text-capitalize">{{ $category->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            @php $featuredPosts = App\Models\Blog::where('is_featured', 1)->latest()->take(4)->get(); @endphp
                            @foreach($featuredPosts as $post)
                            <a href="{{ route('blogs.show', $post->slug) }}" class="blog__sidebar__recent__item border-bottom p-2">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6 class="h2 text-dark text-capitalize">{{ $post->title }}</h6>
                                    <small class="d-block text-dark" >{{ Str::limit($post->short_description, 50) }}</small>
                                    <span >{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags" id="tag-filter">
                            <a href="#" data-tag-id="" class="tag-link badge badge-secondary p-2 shadow rounded">All</a>
                            @foreach($tags as $tag)
                            <a href="#" data-tag-id="{{ $tag->id }}" class="tag-link badge badge-secondary p-2 shadow rounded">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 ">
                <div class="row" id="blog-list">
                    <div class="blog__item__text">
                        <div class="row">
                            <div class="col-6">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('M d, Y') }}</li>
                                    <li><i class="fa fa-comment-o"></i>{{ $blog->comments_count }}</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-wrap">
                                    <div class="mr-3">
                                        <span class="badge badge-primary shadow">Categories:</span>
                                        @foreach($blog->categories as $category)
                                            <span class="badge badge-danger shadow">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <div>
                                        <span class="badge badge-primary shadow">Tags:</span>
                                        @foreach($blog->tags as $tag)
                                            <span class="badge badge-danger shadow">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       <!-- <h5><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a></h5> -->
                        <p>{!!  $blog->description??'' !!}</p>
                    </div>
                </div>
                <!-- Relevant Blogs Section Begin -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <h4>Relevant Blogs</h4>
                    </div>
                    
                </div>
                <!-- Relevant Blogs Section End -->
                 
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h2>Relevent Blogs</h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
            @php $relevantBlogs = App\Models\Blog::where('id', '!=', $blog->id)->inRandomOrder()->take(2)->get(); @endphp
                    
                    @foreach($relevantBlogs as $relevantBlog)
                    <div class="col-lg-4 col-md-4 col-sm-6 blog-item">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('storage/' . $relevantBlog->image) }}" alt="{{ $relevantBlog->title }}">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ $relevantBlog->created_at->format('M d, Y') }}</li>
                                    <li><i class="fa fa-comment-o"></i> {{ $relevantBlog->comments_count }}</li>
                                </ul>
                                <h5><a href="{{ route('blogs.show', $relevantBlog->slug) }}">{{ $relevantBlog->title }}</a></h5>
                                <p>{!! Str::limit($relevantBlog->short_description, 100) !!}</p>
                                <a href="{{ route('blogs.show', $relevantBlog->slug) }}" class="blog__btn btn btn-block">READ MORE <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach 
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#toggle-layout').on('click', function() {
            $('#blog-list').toggleClass('row-cols-1 row-cols-md-3');
            $('.blog-item').toggleClass('col-md-4 col-md-12');
            $('.card').toggleClass('flex-md-row');
            $('.card-img-top').toggleClass('w-100 w-md-50');
        });

        function updateActiveLinks(categoryId, tagId) {
            $('.category-link').removeClass('active');
            $('.tag-link').removeClass('active');
            if (categoryId) {
                $('.category-link[data-category-id="' + categoryId + '"]').addClass('active');
            }
            if (tagId) {
                $('.tag-link[data-tag-id="' + tagId + '"]').addClass('active');
            }
        }

        $('#search, #category-filter a, #tag-filter a').on('keyup click', function(e) {
            e.preventDefault();
            var search = $('#search').val();
            var category = $(this).data('category-id');
            var tag = $(this).data('tag-id');

            updateActiveLinks(category, tag);

            $.ajax({
                url: '{{ route("blogs.index") }}',
                method: 'GET',
                data: {
                    search: search,
                    category: category,
                    tag: tag
                },
                success: function(response) {
                    $('#blog-list').html(response);
                }
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .breadcrumb-section {
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .breadcrumb__text h2 {
        color: #fff;
        font-size: 36px;
        font-weight: 700;
    }

    .breadcrumb__option a {
        color: #fff;
        font-size: 16px;
    }

    .breadcrumb__option span {
        color: #fff;
        font-size: 16px;
    }

    .blog__sidebar {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
    }

    .blog__sidebar__search input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .blog__sidebar__item h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .blog__sidebar__item ul {
        list-style: none;
        padding: 0;
    }

    .blog__sidebar__item ul li {
        margin-bottom: 10px;
    }

    .blog__sidebar__item ul li a {
        color: #007bff;
        text-decoration: none;
    }

    .blog__sidebar__recent__item {
        display: flex;
        margin-bottom: 20px;
    }

    .blog__sidebar__recent__item__pic {
        width: 80px;
        height: 80px;
        overflow: hidden;
        border-radius: 10px;
        margin-right: 20px;
    }

    .blog__sidebar__recent__item__pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog__sidebar__recent__item__text h6 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .blog__sidebar__recent__item__text span {
        font-size: 14px;
        color: #6c757d;
    }

    /* .blog__sidebar__item__tags a {
        display: inline-block;
        background: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px 0;
        text-decoration: none;
    } */

    .blog__sidebar__item__tags a.active {
        background-color: gainsboro;
    }

    .blog__item {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .blog__item__pic {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .blog__item__pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog__item__text {
        padding: 20px;
    }

    .blog__item__text ul {
        list-style: none;
        padding: 0;
        margin-bottom: 10px;
    }

    .blog__item__text ul li {
        display: inline-block;
        margin-right: 10px;
        color: #6c757d;
    }

    .blog__item__text h5 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .blog__item__text p {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .product__pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .product__pagination a {
        display: inline-block;
        background: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 0 5px;
        text-decoration: none;
    }

    .product__pagination a:hover {
        background: #0056b3;
    }

    .category-image {
        width: 40px;
    }

    .category-link.active {
        font-weight: bold;
        color: #0056b3;
    }
</style>
@endpush