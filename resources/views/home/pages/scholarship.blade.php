@extends('home.layouts.site_home')

@section('content')
<section class="w3l-blog-single">
    <section class="w3l-blog-single1 py-5">
        <div class="container py-lg-3">
            <div class="d-grid-1">
                <div class="text">
                    <h3 class="text-title">Info Beasiswa</h3>
                </div>
            </div>
            {{-- <div class="text-bg-image">
                <img class="text-bg-image" src="{{ asset('/storage/blog_image/'.$blog->blog_image) }}" alt="Main Image">
            </div> --}}
            @if($scholarship->content)
            <div class="text-content-text">
                <div class="d-grid-2">
                    <div class="text2">
                        <div class="text2-text">
                            {!!$scholarship->content!!}
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="text-content-text">
                <div class="d-grid-2">
                    <div class="text2">
                        <div class="text2-text">
                            Infromasi Saat Ini Belum Tersedia
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</section>
@endsection