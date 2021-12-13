@extends('home.layouts.site_home')

@section('content')
<section class="w3l-aboutblock1 py-5" id="bottom">
    <div class="container py-lg-5 py-md-3">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="title-small mb-3">Tentang</h5>
                <h3 class="title-big">SEHATKO </h3>
                <p class="text-justify">
                    Semua artikel di SEHATKO telah melalui proses riset dan ditulis berdasarkan studi terbaru serta ditinjau oleh pakar terkemuka dari berbagai institusi medis.                </p>
                <br>
                <p class="text-justify">Tim editor medis kami adalah dokter dan pakar yang datang dari berbagai latar belakang keilmuan medis. Mereka meninjau setiap konten kami secara profesional. </p>
                <br>
                <p class="text-justify">
                    Bersama para editor medis dan pakar profesional, kami selalu memantau artikel kami secara berkala guna memastikan tingkat akurasi dan relevansi dengan pembaca.   </p>
                <br>
                <p class="text-justify">
                    SEHATKO, sebagai platform kesehatan terdepan di Indonesia berkomitmen untuk menulis artikel yang akurat, relevan dan terbaru untuk membantu Anda para pembaca dalam membuat keputusan penting terkait kesehatan.                </p>
                <br>
            </div>
        </div>
    </div>
</section>

@if(count($testimonies) > 0)
<section class="w3l-testimonials py-5" id="testimonials">
    <!-- main-slider -->
    <div class="container py-lg-5 py-md-4 mb-md-0 mb-md-5 mb-4">
        <div class="heading text-center mx-auto">
            <h5 class="title-small text-center mb-2">Testimoni</h5>
            <h3 class="title-big text-center mb-5">SEHATKO</h3>
        </div>
        <div class="owl-one owl-carousel owl-theme">
            @foreach($testimonies as $testimony)
            <div class="item">
                <div class="slider-info">
                    <div class="img-circle">
                        <img src="{{ asset('/storage/testimony/'.$testimony->photo) }}" class="img-fluid rounded" alt="client image">
                    </div>
                    <div class="message-info">
                        <span class="fa fa-quote-left mr-2"></span>
                        <div class="message">{{$testimony->testi}}.</div>
                        <div class="name">- {{$testimony->name}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /main-slider -->
</section>
@endif
@endsection