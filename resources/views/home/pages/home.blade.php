@extends('home.layouts.main_home')

@section('content')
<section class="w3l-index3" id="bottom">
    <div class="midd-w3 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6 about-right-faq align-self">
                    {{-- <h5 class="title-small mb-3">Sejarah g</h5> --}}
                    <h3 class="title-big">Tentang SEHATKO</h3>
                    <p class="text-justify">
                        Semua artikel di SEHATKO telah melalui proses riset dan ditulis berdasarkan studi terbaru serta ditinjau oleh pakar terkemuka dari berbagai institusi medis.
                        Tim editor medis kami adalah dokter dan pakar yang datang dari berbagai latar belakang keilmuan medis. Mereka meninjau setiap konten kami secara .........                   </p>                   
                    <a href="/about" class="btn btn-style border-btn mt-lg-5 mt-4">Selengkapnya...</a>
                </div>
                <div class="col-lg-6 left-wthree-img text-right mt-lg-0 mt-5 ">
                    <img src="{{ asset('/storage/web_assets/genbi.png') }}" alt="" class="radius-image img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /homeblock2-->

<!-- //homeblock2-->



@if(count($latestBlog) > 0)
<section class="w3l-blog">
    <section id="grids5-block" class="py-5">
        <div class="container py-lg-5 py-md-4">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Blog Terbaru</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <div class="list-view mt-5">
                <div class="row">
                    @foreach ($latestBlog as $blog)
                    <div class="col-md-6 mt-5">
                        <div class="grids5-info">
                            <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}" class="d-block zoom"><img src="{{ asset('/storage/blog_image/'.$blog->blog_image) }}" alt=""
                                    class="img-fluid news-image" /></a>
                            <div class="blog-info">
                                <h4><a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}">{{$blog->title}}</a></h4>
                                <p class="date">{{$blog->created_at->format('d-m-Y')}}</p>
                                <p class="blog-text">{{Illuminate\Support\Str::limit(strip_tags($blog->content), 50)}}</p>
                                <a href="/blog/{{strtolower($blog->category->category_name)}}/{{strtolower($blog->title)}}" class="btn  mt-4">Read More <span></span></a>
                            </div>
                        </div>
                    </div>                
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</section>
@endif

@if(count($latestImage) > 0)
<section class="w3l-homeblock4 py-5" id="video">
    <div class="video-recipe py-lg-5 py-md-3">
        <div class="container">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Image Terbaru</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <div class="row">
                
                <ul class="gallery_agile">
                        @foreach ($latestImage as $gallery)
                        <li>
                            <div class="w3_agile_portfolio_grid">
                                <a href="{{ asset('/storage/gallery/'.$gallery->image) }}">
                                    <img src="{{ asset('/storage/gallery/'.$gallery->image) }}" alt=" " class="img-fluid radius-image" />
                                    <div class="w3layouts_news_grid_pos">
                                        <div class="wthree_text">
                                            <h3>{{$gallery->title}}</h3>
                                            <p>{{$gallery->description}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>                
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif

@if(count($latestVideo) > 0)
<section class="w3l-homeblock4 py-5" id="video">
    <div class="video-recipe py-lg-5 py-md-3">
        <div class="container">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Image Terbaru</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <div class="row">
                
                <ul class="gallery_agile">
                    @foreach ($latestVideo as $video)
                <li>
                    <div class="w3_agile_portfolio_grid">
                            <iframe src="{{$video->link}}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <a class="play-yt" href="{{$video->link}}">
                        <h3 class="video-title mt-4">{{$video->title}}</h3>
                        </a>
                    </div>
                </li>                            
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif


{{-- <div class="w3l-bg-image">
    <div class="bg-mask py-5">
        <div class="container py-lg-5 py-4">
            <div class="text-align text-center py-lg-4 py-md-3">
                <h3>Quotes</h3>
                <p>“If you spend too much time thinking about a thing, you’ll never get it done. Make at least one definite move daily toward your goal.”</p>
            </div>
        </div>
    </div> --}}
</div>
@endsection