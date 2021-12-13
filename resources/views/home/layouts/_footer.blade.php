
    <section class="w3l-footer-29-main py-5">
        <div class="footer-29 py-lg-4 py-md-3">
            <div class="container">
                <div class="d-grid grid-col-4 footer-top-29">
                    <div class="footer-list-29 footer-1">
                        <h6 class="footer-title-29">Kontak Kami</h6>
                        <ul>
                            <li>
                            <p><span class="fa fa-map-marker"></span>{{$contact->secretariat}}</p>
                            </li>
                            <li><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=sehatko@gmail.com&tf=1" class="mail"><span
                                        class="fa fa-envelope-open-o"></span>{{$contact->email}}</a></li>
                        </ul>
                        <div class="main-social-footer-29">
                            <a href="{{$contact->instagram}}" class="facebook"><span class="fa fa-instagram"></span></a>
                            <a href="{{$contact->youtube}}" class="google-plus"><span class="fa fa-youtube"></span></a>
                            <a href="{{$contact->podcast}}" class="twitter"><span class="fa fa-spotify"></span></a>
                        </div>
                    </div>
                    <div class="footer-list-29 footer-2">

                        <h6 class="footer-title-29">Telusuran Cepat</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="/">Beranda</a></li>
                                    <li><a href="/about">Tentang</a></li>
            
                                    <li><a href="/blog/all">Blog</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="/gallery">Foto</a></li>
                                    <li><a href="/video">Video</a></li>
                                   
                                    <li><a href="/contact-us">Kontak</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="footer-3" id="contact-us-form">
                        <ul>
                            <h6 class="footer-title-29">Hubungi Kami</h6>
                            <form class="d-block" id='form-contact-us' method="post" data-toggle="validator" action="/send-message">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" placeholder="Nama" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="email" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="phone_number" placeholder="Nomor Telepon" required="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message_content" required="" placeholder="Pesan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" style="background-color: #d62459;" class="btn btn-style btn-danger submit">Kirim</button>
                                </div>
                            </form>
                        </ul>
                    </div> 
                </div>
                <div class="d-grid grid-col-2 bottom-copies">
                    <p class="copy-footer-29">© 2021 SEHATKO. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="Go to top">
            <span class="fa fa-angle-up"></span>
        </button>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
        <!-- /move top -->
    </section>