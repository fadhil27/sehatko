@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div id="scholarship-form">
        <form id='form-scholarship' method="post" data-toggle="validator" action="{{ action('ScholarshipController@update', ['scholarship'=>1]) }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="container-fluid">
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-primary">
                            {{ session('status') }}
                        </div>
                        @endif 
                        <textarea id="content" class="form-control" name="content" rows="10" cols="50">{{$scholarship->content}}</textarea>
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
        var content = document.getElementById("content");
            CKEDITOR.replace(content,{
            language:'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
        
        // $(document).ready(function(){
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ url('administrator/scholarship') }}",
        //         dataType: "JSON",
        //         success: function (data) {
        //             CKEDITOR.instances.content.setData(data.scholarship.content);
        //             // $('#content').val(data.scholarship.content)
        //         }
        //     });
        // });

        // $(function(){
        //     $('#scholarship-form form').validator().on('submit', function (e){
        //         if (!e.isDefaultPrevented()){
        //             $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });

        //             let id = 1;
        //             url = "{{ url('administrator/scholarship') . '/' }}" + id;
                    
        //             $.ajax({
        //                 url: url,
        //                 type: "PUT",
        //                 // data: new FormData($("#scholarship-form form")[0]),
        //                 data : $('#scholarship-form form').serialize(),
        //                 // contentType: false,
        //                 // processData: false,
        //                 success: function (data) {
        //                     swal({
        //                         title: 'Success!',
        //                         text: data.message,
        //                         type: 'success',
        //                         timer: '1500'
        //                     }).catch(swal.noop);
        //                 }, 
        //                 error : function() {
        //                     swal({
        //                             title: 'Oops...',
        //                             text: "Something when wrong!",
        //                             type: 'error',
        //                             timer: '1500'
        //                     }).catch(swal.noop);
        //                 }
        //             });
        //             return false;
        //         }
        //     });
        // });
    </script>
@endsection
