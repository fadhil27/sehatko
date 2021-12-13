@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div id="contact-form">
        <form id='form-contact' method="post" data-toggle="validator">
            {{ method_field('POST') }}
            <div class="container-fluid">
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Secretariat</label>
                                    <input name="secretariat" type="text" class="form-control" id="secretariat">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" id="email">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input name="instagram" type="text" class="form-control" id="instagram">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input name="youtube" type="text" class="form-control" id="youtube">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row text-center justify-content-center">
                            <div class="col col-sm-6">
                                <div class="form-group">
                                    <label>Podcast</label>
                                    <input name="podcast" type="text" class="form-control" id="podcast">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('ajax')
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "{{ url('administrator/contact') }}",
                dataType: "JSON",
                success: function (data) {
                    $('#secretariat').val(data.contact.secretariat)
                    $('#instagram').val(data.contact.instagram)
                    $('#email').val(data.contact.email)
                    $('#youtube').val(data.contact.youtube)
                    $('#podcast').val(data.contact.podcast)
                }
            });
        });

        $(function(){
            $('#contact-form form').validator().on('submit', function (e){
                if (!e.isDefaultPrevented()){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let id = 1;
                    url = "{{ url('administrator/contact') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "PUT",
                        // data: new FormData($("#contact-form form")[0]),
                        data : $('#contact-form form').serialize(),
                        // contentType: false,
                        // processData: false,
                        success: function (data) {
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            }).catch(swal.noop);
                        }, 
                        error : function() {
                            swal({
                                    title: 'Oops...',
                                    text: "Something when wrong!",
                                    type: 'error',
                                    timer: '1500'
                            }).catch(swal.noop);
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection