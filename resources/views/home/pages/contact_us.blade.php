@extends('home.layouts.site_home')

@section('content')
<section class="w3l-contact-6 py-5" id="contact">
    <div class="contact-info  py-lg-4 py-md-3">
        <div class="container">
            <div class="title-content mb-5">
                <h5 class="title-small text-center mb-2">Kontak</h5>
                <h3 class="title-big text-center mb-5">Team Sehatko</h3>
            </div>
            <div class="grid contact-grids pt-3">
                <div class="contact-left">
                    <div class="grid">
                        <span class="fa fa-envelope-o"></span>
                        <div class="email-info">
                            <span>Email:</span>
                            <a target="_blank" rel="noopener noreferrer" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=sehatko@gmail.com&tf=1">sehatko@gmail.com</a>
                        </div>
                    </div>
                </div>
                <div class="contacts12-main" id="contact-us-form">
                    <form id='form-contact-us' method="post" data-toggle="validator" action="/send-message">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="input-grids">
                            <div class="form-group">
                                <label class="form-field" for="w3lName">Nama</label>
                                <input type="text" class="form-control" type="text" name="name" id="name" placeholder="Nama Anda"
                                    class="contact-input" required/>
                                <span class="help-block with-errors text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label class="form-field" for="w3lSender">Email</label class="form-field">
                                <input type="email" name="email" id="email" placeholder="Email Anda"
                                    class="contact-input" required/>
                                <span class="help-block with-errors text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-field" for="w3lSubect">Nomor Telepon</label class="form-field">
                            <input type="text" name="phone_number" id="phone_number" placeholder="Nomor Telp"
                                class="contact-input" required/>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-field" for="w3lMessage">Pesan</label class="form-field">
                            <textarea name="message_content" id="message_content" placeholder="Pesan anda"
                                required></textarea>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="text-right">
                            <button type="submit" style="background-color: #d62459;" class="btn btn-style btn-danger submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection

@section('script')
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
@endsection