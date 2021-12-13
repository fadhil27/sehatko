@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-12">
                            <div class="float-sm-right">
                                <button onclick="addYoutube()" type="button" class="btn btn-outline-primary"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="youtube-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

{{-- Modal Create Data --}}
<div class="modal fade" id="youtube-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-youtube" method="POST" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Link:</label>
                        <input type="text" class="form-control" name="link" id="link" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button id="type-button" type="submit" class="btn btn-outline-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('ajax')
    <script type="text/javascript">
        let table = $('#youtube-table').DataTable({
            processing : true,
            serverSide : true,
            "responsive": true,
            "autoWidth": false,
            ajax : "{{ route('youtube.index') }}",
            columns : [
                {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
                },
                {data:'title', name:'title'},
                {data:'link', name:'link'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        
        function addYoutube(){
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#youtube-form').modal('show');
            $('#type-button').show();
            $('#youtube-form form')[0].reset();
            $('.modal-title').text('Add Youtube Content');
            $('#type-button').text('Add');
            $('.form-control').removeAttr("readonly","");
        }

        function viewYoutube(id){
            $('#youtube-form form')[0].reset();
            $.ajax({
                type: "GET",
                url: "{{ url('administrator/youtube') }}" + '/' + id,
                dataType: "JSON",
                success: function(data){
                    $('#youtube-form').modal('show');
                    $('.modal-title').text('View Youtube Content');
                    $('#type-button').hide();
                    $('.form-control').attr("readonly","");
                    $('#title').val(data.title);
                    $('#link').val(data.link);
                },
                error: function(){
                    swal({
                            title: 'Oops...',
                            text: 'Something when wrong!',
                            type: 'error',
                            time: '1500'
                    }).catch(swal.noop);
                }
            });
        }

        function editYoutube(id){
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#youtube-form form')[0].reset();
            $.ajax({
                url: "{{ url('administrator/youtube') }}" + '/' + id + '/edit',
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#youtube-form').modal('show');
                    $('.modal-title').text('Update Youtube Content');
                    $('#type-button').text('Edit');
                    $('#type-button').show();
                    $('.form-control').removeAttr("readonly","");
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#link').val(data.link);
                },
                error: function () {
                    swal({
                            title: 'Oops...',
                            text: 'Something when wrong!',
                            type: 'error',
                            time: '1500'
                    }).catch(swal.noop);
                }
            });
        }

        function deleteYoutube(id) {
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    type: "POST",
                    url: "{{ url('administrator/youtube') }}" + '/' + id,
                    data: {
                        '_method': 'DELETE',
                        '_token': csrf_token
                    },
                    success: function (data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success',
                            text: 'Data has been deleted',
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error: function () {
                        swal({
                            title: 'Oops...',
                            text: 'Something when wrong!',
                            type: 'error',
                            timer: '1500'
                        }).catch(swal.noop);
                    }
                });
            })
        }

        $(function(){
            $('#youtube-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('administrator/youtube') }}";
                    else url = "{{ url('administrator/youtube') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        // data : $('#admin-form form').serialize(),
                        data: new FormData($("#youtube-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#youtube-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            }).catch(swal.noop);
                        },
                        error : function(data){
                            $('#youtube-form').modal('hide');
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