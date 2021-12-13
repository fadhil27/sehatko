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
                                <button onclick="addJumbotron()" type="button" class="btn btn-outline-primary"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="jumbotron-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Background</th>
                                    <th>Title Background</th>
                                    <th>Info Background</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>
                                        <img src="{{ asset('/storage/web_assets/genbiUH.png') }}" width="200" class="img-thumbnail rounded mx-auto d-block" />
                                    </td>
                                    <td style="vertical-align:middle; text-align:center;">Leadership Development</td>
                                    <td  style="vertical-align:middle; text-align:center;">
                                        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                    </td>
                                </tr> --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Background</th>
                                    <th>Title Background</th>
                                    <th>Info Background</th>
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
<div class="modal fade" id="jumbotron-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Background</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
            <form id="form-jumbotron" method="POST" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                    <div id="pre" class="form-group">
                        {{-- <img src="{{ asset('/storage/web_assets/genbiUH.png') }}" width="200" class="img-thumbnail rounded mx-auto d-block" /> --}}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Background </label>
                        <input class="form-control-file" id="input-mainBackground" type="file" name="background_image" id="background_image" onchange="readURL(this)" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title Background</label>
                        <input type="text" class="form-control" id="title_image" name="title_image" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Info Background</label>
                        <input type="text" class="form-control" id="information_image" name="information_image" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
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
    let table = $('#jumbotron-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('jumbotron.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {
            data:'background_image', 
            name:'background_image',
            render: function (data, type, full, meta) {
                    return `<img src="{{ asset('/storage/backgroundImage/${data}') }}" width="200" class="img-thumbnail rounded mx-auto d-block" />`;
                },
            "title": "Image",
            "orderable": true,
            "searchable": true
            },
            {data:'title_image', name:'title_image'},
            {data:'information_image', name:'information_image'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    function addJumbotron(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#jumbotron-form').modal('show');
        $('#pre').html('');
        $('#type-button').show();
        // $('#input-photo').show();
        $('#jumbotron-form form')[0].reset();
        $('#input-mainBackground').attr("required","");
        $('.modal-title').text('Add Main Background');
        $('#type-button').text('Add');
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#preview').attr('src', e.target.result);
                let img = e.target.result;
                $('#pre').html(`<img src="${img}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function editJumbotron(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#jumbotron-form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/jumbotron') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#jumbotron-form').modal('show');
                $('.modal-title').text('Update Main Background');
                $('#type-button').text('Edit');
                $('#type-button').show();
                // $('#input-photo').show();
                $('#pre').html(`<img src="{{ asset('/storage/backgroundImage/${data.background_image}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#input-mainBackground').removeAttr("required","");
                $('#id').val(data.id);
                $('#title_image').val(data.title_image)
                $('#information_image').val(data.information_image);
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

    function deleteJumbotron(id) {
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
                url: "{{ url('administrator/jumbotron') }}" + '/' + id,
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
        $('#jumbotron-form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#id').val();
                if (save_method == 'add') url = "{{ url('administrator/jumbotron') }}";
                else url = "{{ url('administrator/jumbotron') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#admin-form form').serialize(),
                    data: new FormData($("#jumbotron-form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        $('#jumbotron-form').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error : function(data){
                        $('#jumbotron-form').modal('hide');
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