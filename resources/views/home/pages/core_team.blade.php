@extends('home.layouts.site_home')

@section('content')
<section class="w3l-destinations-1" id="gallery">
    <div class="destionation-innf py-5">
        <div class="container py-lg-4 py-md-3">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">New Face of</h5>
                <h3 class="title-big text-center mb-5">SEHATKO</h3>
            </div>
            <!--/coffee grids-grids-->
            @foreach ($chief as $c)
            <div class="row mb-5">
                <div class="col-md-5 col-6 px-4 mx-auto">
                    <div class="w3_agile_portfolio_grid">
                        <a href="{{ asset('/storage/organizer/'.$c->photo) }}">
                            <img src="{{ asset('/storage/organizer/'.$c->photo) }}" alt=" "
                                class="img-fluid radius-image" />
                            <div class="w3layouts_news_grid_pos">
                                <div class="wthree_text">
                                    <h3>{{$c->name}}</h3>
                                    <p>{{$c->position}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="w3_agile_portfolio_grid mt-2">
                        <h4 class='align-center'><a href="{{ asset('/storage/organizer/'.$c->photo) }}">{{$c->name}}</a>
                        </h4>
                    </div>
                    <h6>{{$c->position}}</h6>
                    <div class="team-info">
                        <div class="caption">
                            <div class="social-icons-section text-center">
                                <a target="_blank" rel="noopener noreferrer" class="fac"
                                    href="https://www.instagram.com/{{$c->instagram}}">
                                    <span class="fa fa-instagram"></span>
                                </a>
                                <a target="_blank" rel="noopener noreferrer" class="twitter"
                                    href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to={{$c->email}}&tf=1">
                                    <span class="fa fa-envelope"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-md-10 p-0 mx-auto">
                <ul class="row">
                    @foreach ($presidium as $m)
                    <li class="col-6 px-4 mb-5">
                        <div class="w3_agile_portfolio_grid">
                            <a href="{{ asset('/storage/organizer/'.$m->photo) }}">
                                <img src="{{ asset('/storage/organizer/'.$m->photo) }}" alt=" "
                                    class="img-fluid radius-image" />
                                <div class="w3layouts_news_grid_pos">
                                    <div class="wthree_text">
                                        <h3>{{$m->name}}</h3>
                                        <p>{{$m->position}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="w3_agile_portfolio_grid mt-2">
                            <h4 class='align-center'><a
                                    href="{{ asset('/storage/organizer/'.$m->photo) }}">{{$m->name}}</a></h4>
                        </div>
                        <h6>{{$m->position}}</h6>
                        <div class="team-info">
                            <div class="caption">
                                <div class="social-icons-section text-center">
                                    <a target="_blank" rel="noopener noreferrer" class="fac"
                                        href="https://www.instagram.com/{{$m->instagram}}">
                                        <span class="fa fa-instagram"></span>
                                    </a>
                                    <a target="_blank" rel="noopener noreferrer" class="twitter"
                                        href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to={{$c->email}}&tf=1">
                                        <span class="fa fa-envelope"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @foreach ($divisions as $division)
                    @if ($loop->first)
                    <ul class="row">
                        @foreach (json_decode($division->photo) as $photo)
                        <li class="col-6 px-4">
                            <div class="w3_agile_portfolio_grid">
                                <a href="{{ asset('/storage/organizer/'.$photo) }}">
                                    <img src="{{ asset('/storage/organizer/'.$photo) }}" alt=" "
                                        class="img-fluid radius-image" />
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h4 class='text-center font-weight-bold mt-2'><a href="#" onclick="return false;">{{$division->name}}</a></h4>
                    @else
                    <ul class="row">
                        @foreach (json_decode($division->photo) as $photo)
                        <li class="col-6 px-4 mt-5">
                            <div class="w3_agile_portfolio_grid">
                                <a href="{{ asset('/storage/organizer/'.$photo) }}">
                                    <img src="{{ asset('/storage/organizer/'.$photo) }}" alt=" "
                                        class="img-fluid radius-image" />
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h4 class='text-center font-weight-bold mt-2'><a href="#" onclick="return false;">{{$division->name}}</a></h4>
                    @endif
                @endforeach
            </div>
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