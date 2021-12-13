@extends('home.layouts.site_home')

@section('content')
<section class="w3l-destinations-1" id="gallery">
    <div class="destionation-innf py-5">
        <div class="container py-lg-4 py-md-3">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Gallery</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <!--/coffee grids-grids-->
            <ul class="gallery_agile">
                @foreach ($galleries as $gallery)
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
            <!--//coffee grids-grids-->
        </div>
    </div>
</section>
<!--//coffee grids -->
@endsection

@section('script')
    <!--light-box-files -->
    <script type="text/javascript ">
        $(function () {
            $('.w3_agile_portfolio_grid a').Chocolat();
        });
    </script>
    <!-- /js for portfolio lightbox -->
@endsection