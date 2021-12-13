<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item {{ (Request::routeIs('home.index')) ? 'active' : '' }}">
            <a class="nav-link" href="/">Beranda<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ ((Request::routeIs('home.about')) ? 'active' : '') || ((Request::routeIs('home.coreTeam')) ? 'active' : '') }}">
            
            
                <a class="nav-link" href="/about">Tentang Kami</a>
        </li>

        <li class="nav-item dropdown {{ ((Request::routeIs('home.blogList')) ? 'active' : '') ||  ((Request::routeIs('home.blogListAll')) ? 'active' : '') }}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Blog <span class="fa fa-angle-down"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item @@g__active" href="/blog/all">Semua</a>
                @foreach ($blogCategories as $blogCategory)
                <a class="dropdown-item @@g__active" href="/blog/{{$blogCategory->category_name}}">{{$blogCategory->category_name}}</a>       
                @endforeach
            </div>
        </li>

        <li class="nav-item {{ ((Request::routeIs('home.gallery')) ? 'active' : '') || ((Request::routeIs('home.video')) ? 'active' : '') }}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Galeri <span class="fa fa-angle-down"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item @@g__active" href="/gallery">Foto</a>
                <a class="dropdown-item @@g__active" href="/video">Video</a>
            </div>
        </li>
        
        <li class="nav-item {{ (Request::routeIs('home.contactUs')) ? 'active' : '' }}">
            <a class="nav-link" href="/contact-us">Kontak</a>
        </li>
    </ul>
</div>