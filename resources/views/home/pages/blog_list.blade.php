@extends('home.layouts.site_home')

@section('content')
<section class="w3l-blog">
    <section id="grids5-block" class="py-5">
        <div class="container py-lg-5 py-md-4">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Blog Sehatko</h5>
                <h3 class="title-big text-center mb-5">{{$category}}</h3>
            </div>
            <div class="list-view mt-5">
                <div class="row">
                    @foreach ($blogList as $blog)
                    <div class="col-md-6 mt-5">
                        <div class="grids5-info">
                            <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}" class="d-block zoom"><img src="{{ asset('/../storage/blog_image/'.$blog->blog_image) }}" alt=""
                                    class="img-fluid news-image" /></a>
                            <div class="blog-info">
                                <h4><a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}">{{$blog->title}}</a></h4>
                                <p class="date">{{$blog->created_at->format('d-m-Y')}}</p>
                                <p class="blog-text">{!!Illuminate\Support\Str::limit(strip_tags($blog->content), 50)!!}</p>
                                <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}" class="btn  mt-4">Read More <span></span></a>
                            </div>
                        </div>
                    </div>                
                    @endforeach
                </div>
            </div>
            <!-- pagination -->

                {{ $blogList->links('home.layouts._pagination') }}
            <!-- //pagination -->
        </div>
    </section>
</section>
@endsection