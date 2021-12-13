<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('/storage/web_assets/sehatkologo.png') }}">
    <title>{{$title}}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    
    {{-- Plugin youtube modal --}}
    <link rel="stylesheet" href="{{asset('home/plugin/yu2fvl/src/jquery.yu2fvl.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('home/css/style-liberty.css')}}">

    {{-- SweetAlert2 --}}
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body>
    <!--header-->
    <header id="site-header" class="fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark stroke">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('storage/web_assets/sehatkologo.png') }}" alt="Your logo" title="Your logo" style="width:500px; height:80px;" />
                    
                </a>
                <a class="navbar-brand" href="#index.html">

                </a>
                <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                    <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                    </span>
                </button>
                {{-- Navbar --}}
                @include('home.layouts._navbar')
                {{-- /Navbar --}}
                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container py-1">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
                <!-- //toggle switch for light and dark theme -->
            </nav>
        </div>
    </header>
    <!--/header-->
    <!-- main-slider -->
    <section class="w3l-main-slider" id="home">
        <div class="companies20-content">
            <div class="owl-one owl-carousel owl-theme">
                @foreach ($jumbotrons as $jumbotron)
                <div class="item">
                    <li>
                    <div class="slider-info banner-view bg bg2" style="background-image: url({{ url('/storage/backgroundImage/'.$jumbotron->background_image) }})">
                            <div class="banner-info">
                                <div class="container">
                                    <div class="banner-info-bg">
                                        <h5>{{$jumbotron->title_image}}</h5>
                                        <p class="mt-4">{{$jumbotron->information_image}} </p>
                                        <a class="btn btn-style btn-primary mt-sm-5 mt-4 mr-2" href="/about">
                                            Tentang Kami</a>
                                        <a class="btn btn-style btn-white mt-sm-5 mt-4" href="/blog/all">Blog</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                @endforeach
            </div>
            <!-- <div class="icon-pos">
            <a href="#bottom"><span class="fa fa-arrow-down"></span></a>
        </div> -->
        </div>
    </section>
    <!-- /main-slider -->
    {{-- content --}}
        @yield('content')
    {{-- /content --}}

    @include('home.layouts._footer')

    <!-- Template JavaScript -->
    <script src="{{asset('home/js/jquery-3.3.1.min.js')}}"></script>

    <!-- script for testimonials -->
    <script>
        $(document).ready(function () {
            $('.owl-testimonial').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                responsiveClass: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    480: {
                        items: 1,
                        nav: false
                    },
                    667: {
                        items: 1,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true
                    }
                }
            })
        })
    </script>
    <!-- //script for testimonials -->

    <script src="{{asset('home/js/theme-change.js')}}"></script>

    <!-- js for portfolio lightbox -->
    <script src="{{asset('home/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('home/js/jquery.chocolat.js')}}"></script>
    <!--light-box-files -->
    <script type="text/javascript ">
        $(function () {
            $('.w3_agile_portfolio_grid a').Chocolat();
        });
    </script>
    <!-- /js for portfolio lightbox -->

    <script src="{{asset('home/js/owl.carousel.js')}}"></script>
    <!-- script for banner slider-->
    <script>
        $(document).ready(function () {
            $('.owl-one').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    480: {
                        items: 1,
                        nav: false
                    },
                    667: {
                        items: 1,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true
                    }
                }
            })
        })
    </script>
    <!-- //script -->


    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!--/MENU-JS-->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!--//MENU-JS-->

    <script src="{{asset('home/js/bootstrap.min.js')}}"></script>

    <script src="{{ asset('plugins/validator/validator.min.js') }}"></script>
    <script src="{{asset('home/plugin/yu2fvl/src/jquery.yu2fvl.js')}}"></script>
    <script>
        $(".play-yt").yu2fvl();
    </script>
    <script type="text/javascript">
        $('#contact-us-form form').validator().on('submit', function (e){
            if (!e.isDefaultPrevented()){
                url = "{{ url('send-message') }}"
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData($("#contact-us-form form")[0]),
                    // data : $('#contact-us-form form').serialize(),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '6000'
                        }).catch(swal.noop);
                        $('#form-contact-us').trigger("reset");
                    }, 
                    error : function() {
                        swal({
                                title: 'Oops...',
                                text: "Something when wrong!",
                                type: 'error',
                                timer: '6000'
                        }).catch(swal.noop);
                    }
                });
                return false;
            }
        });
        </script>
</body>

</html>