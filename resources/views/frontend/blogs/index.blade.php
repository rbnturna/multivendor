<!-- filepath: /c:/xampp/htdocs/multi-vendor/resources/views/frontend/blogs/index.blade.php -->
@extends('frontend.layout.master')

@section('content')

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search..." id="search" >
                            <!-- <button type="submit"><span class="icon_search"></span></button> -->
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul id="category-filter">
                            <li class="d-flex justify-content-between align-items-center">
                                
                                <!-- <img src="{{ asset('assets/images/shop/09.webp') }}" alt="All" class="category-image img-thumbnail rounded mr-2"> -->

                                <a href="#" data-category-id="" class="category-link btn btn-outline-warning  btn-block">
                                    
                                All Categories</a></li>
                            @foreach($categories as $category)
                            <li>
                                <a href="#" data-category-id="{{ $category->id }}" class="category-link">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image img-thumbnail rounded">
                                    {{ $category->name }}
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
                            <a href="{{ route('blogs.show', $post->slug) }}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{ $post->title }}</h6>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Search By</h4>
                        <div class="blog__sidebar__item__tags" id="tag-filter">
                            <a href="#" data-tag-id="" class="tag-link">All</a>
                            @foreach($tags as $tag)
                            <a href="#" data-tag-id="{{ $tag->id }}" class="tag-link">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row" id="blog-list">
                    @foreach($blogs as $blog)
                    <div class="col-lg-6 col-md-6 col-sm-6 blog-item">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('M d, Y') }}</li>
                                    <li><i class="fa fa-comment-o"></i> {{ $blog->comments_count }}</li>
                                </ul>
                                <h5><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a></h5>
                                <p>{{ Str::limit($blog->short_description, 100) }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-block btn-outline-warning rounded">READ MORE <i class="fa  fa-arrow-right ml-3"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            {{-- $blogs->links() --}}
                        </div>
                    </div>
                </div>
                <!-- Relevant Blogs Section Begin -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <h4>Relevant Blogs</h4>
                    </div>
                    {{-- @foreach($relevantBlogs as $relevantBlog)
                    <div class="col-lg-6 col-md-6 col-sm-6 blog-item">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ $relevantBlog->image_url }}" alt="{{ $relevantBlog->title }}">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ $relevantBlog->created_at->format('M d, Y') }}</li>
                                    <li><i class="fa fa-comment-o"></i> {{ $relevantBlog->comments_count }}</li>
                                </ul>
                                <h5><a href="{{ route('blogs.show', $relevantBlog->slug) }}">{{ $relevantBlog->title }}</a></h5>
                                <p>{{ Str::limit($relevantBlog->description, 100) }}</p>
                                <a href="{{ route('blogs.show', $relevantBlog->slug) }}" class="blog__btn btn btn-block">READ MORE <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach --}}
                </div>
                <!-- Relevant Blogs Section End -->
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

    /* .blog__sidebar__search button {
        background: #007bff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        color: #fff;
    } */

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

    .blog__sidebar__item__tags a {
        display: inline-block;
        background: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px 0;
        text-decoration: none;
    }

    .blog__sidebar__item__tags a.active {
        background: #0056b3;
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

    /* .blog__btn {
        display: inline-block;
        background: #FFD333 !important;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
    } */

    /* .blog__btn:hover {
        background: #0056b3;
    } */

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
        /* height: 70px;
        border:1px solid #ddd;
        margin-right: 10px;
        border-radius: 50%;
        object-fit: cover; */
    }

    .category-link.active {
        font-weight: bold;
        color: #0056b3;
    }
</style>
@endpush