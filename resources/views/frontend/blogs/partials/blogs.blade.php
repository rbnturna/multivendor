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
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach