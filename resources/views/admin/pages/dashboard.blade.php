@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$count['blog']}}</h3>

                        <p>Blog</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bookmark"></i>
                    </div>
                    <a href="/administrator/blog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$count['video']}}</h3>

                        <p>Video</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-youtube"></i>
                    </div>
                    <a href="/administrator/youtube" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
          
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$count['image']}}</h3>

                        <p>Gallery</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <a href="/administrator/gallery" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row --> 
        
    </div>
    <!-- /.container-fluid -->

</section>
@endsection