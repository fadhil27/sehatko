<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Sehatko </title>
    <link rel="icon" type="image/png" href="{{ asset('/storage/web_assets/sehatkologo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
   
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}

    {{-- SweetAlert2 --}}
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Grafik -->
    <script src="{{asset('js/grafik.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>

{{-- <body class="hold-transition sidebar-mini layout-fixed"> --}}
<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Sidebar user panel (optional)
            <div class="user-panel mt-3 pb-3 mb-3 pl-5 d-flex">
                <div class="image">
                    <img src="img/Logo_UH.png" alt="Logo Image">
                </div>
            </div> -->
            <!-- Brand Logo -->
            <a href="/administrator" class="brand-link">
                <img src="{{ asset('/storage/web_assets/sehatkologo.png') }}" alt="AdminLTE Logo" class="brand-image"
                    style="opacity: .8; height:50px; width:80px">
                <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                <span class="brand-text font-weight-light">Admin Sehatko</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/administrator" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                            
                        </li>
                        <li class="nav-header">MAIN MENUS</li>
                        <li class="nav-item {{ ((Request::routeIs('blog.index')) ? 'menu-open' : '') || ((Request::routeIs('category.index')) ? 'menu-open' : '') || ((Request::routeIs('blog.create')) ? 'menu-open' : '') || ((Request::routeIs('blog.edit')) ? 'menu-open' : '') }}">
                            <a class="nav-link {{ ((Request::routeIs('blog.index')) ? 'menu-open' : '') || ((Request::routeIs('category.index')) ? 'menu-open' : '') || ((Request::routeIs('blog.create')) ? 'menu-open' : '') || ((Request::routeIs('blog.edit')) ? 'menu-open' : '') }}">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Blog
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/administrator/category" class="nav-link  {{ Request::routeIs('category.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/administrator/blog" class="nav-link {{ ((Request::routeIs('blog.index')) ? 'active' : '') || ((Request::routeIs('blog.create')) ? 'active' : '') || ((Request::routeIs('blog.edit')) ? 'active' : '') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Blog Content</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/administrator/youtube" class="nav-link {{ Request::routeIs('youtube.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-video"></i>
                                <p>
                                    Youtube
                                </p>
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a href="/administrator/gallery" class="nav-link {{ Request::routeIs('gallery.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/administrator/testimony" class="nav-link {{ Request::routeIs('testimony.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-quote-left"></i>
                                <p>
                                    Testimony
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MESSAGE</li>
                        <li class="nav-item">
                            <a href="/administrator/inbox" class="nav-link {{ Request::routeIs('inbox.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-inbox"></i>
                                <p>
                                    Inbox
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">SETTINGS</li>
                        <li class="nav-item">
                            <a href="/administrator/jumbotron" class="nav-link {{ Request::routeIs('jumbotron.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chalkboard"></i>
                                <p>
                                    Main Backgrond
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/administrator/contact" class="nav-link {{ Request::routeIs('contact.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Contact SEHATKO
                                </p>
                            </a>
                        </li>
                        @if(auth()->user()->role == 'administrator')
                        <li class="nav-item">
                            <a href="/administrator/admin" class="nav-link {{ Request::routeIs('admin.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    Admin
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                @if (Request::routeIs('administrator'))
                                    Dashboard
                                @elseif(Request::routeIs('blog.index'))
                                    Blog
                                @elseif(Request::routeIs('category.index'))
                                    Category Blog
                                @elseif(Request::routeIs('organizer.index'))
                                    Core Management
                                @elseif(Request::routeIs('jumbotron.index'))
                                    Main Background
                                @elseif(Request::routeIs('gallery.index'))
                                    Gallery
                                @elseif(Request::routeIs('youtube.index'))
                                    Youtube
                                @elseif(Request::routeIs('agenda.index'))
                                    Agenda
                                @elseif(Request::routeIs('contact.index'))
                                    Contact
                                @elseif(Request::routeIs('admin.index'))
                                    Admin
                                @elseif(Request::routeIs('inbox.index'))
                                    Inbox
                                @elseif(Request::routeIs('blog.create'))
                                    Add Blog
                                @elseif(Request::routeIs('update.create'))
                                    Update Blog
                                @elseif(Request::routeIs('scholarship.index') || Request::routeIs('scholarship.update'))
                                    Scholarship Info
                                @elseif(Request::routeIs('testimony.index'))
                                    Testimony
                                @endif
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            {{-- <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol> --}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="http://127.0.0.1:8000/">SEHATKO</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
   
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script> --}}
    {{-- session logout --}}
    {{-- @if (Auth::check()) 
    <script>
    var timeout = ({{config('session.lifetime')}} * 60000) -10 ;
    setTimeout(function(){
        window.location = '/logout';
    },  timeout);
    </script>
    @endif --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.js')}}"></script>
  
    <!-- Page specific script -->
    <script>
        $(function () {
            var dataTable = $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    @yield('ajax')
    {{-- Validator --}}
    <script src="{{ asset('plugins/validator/validator.min.js') }}"></script>
    <script>
        $(".modal").on("hidden.bs.modal", function(){
            $('.form-control').removeAttr("readonly","");
        });
    </script>
    
</body>

</html>
