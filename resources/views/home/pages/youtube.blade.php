@extends('home.layouts.site_home')

@section('content')
<section class="w3l-destinations-1" id="gallery">
    <div class="destionation-innf py-5">
        <div class="container py-lg-4 py-md-3">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Video</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <!--/coffee grids-grids-->
            <ul class="gallery_agile">
                @foreach ($youtubes as $youtube)
                    <li>
                        <div class="w3_agile_portfolio_grid">
                            <iframe src="{{$youtube->link}}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <a class="play-yt" href="{{$youtube->link}}">
                                <h3 class="video-title mt-4">{{$youtube->title}}</h3>
                            </a>
                        </div>
                    </li>                
                @endforeach
            </ul>
            <!--//coffee grids-grids-->
        </div>
    </div>
</section>
<!--//coffee grids -->
@endsection

@section('script')
<script src="{{asset('home/plugin/yu2fvl/src/jquery.yu2fvl.js')}}"></script>
<script>
    $(".play-yt").yu2fvl();
</script>
@endsection