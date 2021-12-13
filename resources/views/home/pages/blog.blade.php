    @extends('home.layouts.site_home')

    @section('content')
    <section class="w3l-blog-single">
        <section class="w3l-blog-single1 py-5">
            <div class="container py-lg-3">
                <div class="d-grid-1">
                    <div class="text">
                        <h3 class="text-title text-center">{{$blog->title}}</h3>
                    </div>
                </div>
                <div class="text-bg-image">
                    <img class="text-bg-image" src="{{ asset('/storage/blog_image/'.$blog->blog_image) }}" alt="Main Image">
                </div>
                <div class="d-grid-1">
                    <div class="text">
                        <ul class="blog-list">
                            <li>
                                <p><span class="fa fa-clock-o"></span>{{$blog->created_at->format('d-m-Y')}}</p>
                            </li>
                            <li>
                            <p><span class="fa fa-user"></span>{{$blog->writer}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-content-text">
                    <div class="d-grid-2">
                        <div class="text2">
                            <div class="text2-text">
                                {!!$blog->content!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //Single post -->
        @if(count($relatedBlogs) > 0)
        <section class="w3l-blog-single5 pb-md-5 pb-2">
            <div class="grid-main py-5">
                <div class="container">
                    <div class="horizontal-align">
                        <div class="grids-titles">
                            <h3 class="grids-title">Related posts</h3>
                        </div>
                        <div class="row">
                            @foreach ($relatedBlogs as $blog)
                            <div class="col-sm-6">
                                <div class="grid-column">
                                    <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}"><img class="card-img-top" src="{{ asset('/storage/blog_image/'.$blog->blog_image) }}"
                                            alt="Card image"></a>
                                    <div class="card-grid">
                                        <div class="card-grid-column1">
                                            <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}">
                                            <h4 class="card-title">{{\Illuminate\Support\Str::limit($blog->title, 20, $end='...')}}</h4>
                                            </a>
                                            <p class="card-text">{!!Illuminate\Support\Str::limit(strip_tags($blog->content,30))!!}</p>
                                        </div>
                                        <div class="card-grid-column2">
                                        <p class="image-caption">{{$blog->category->category_name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
        </section>
        @endif
    </section>
    @endsection