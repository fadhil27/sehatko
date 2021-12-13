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
                                <button onclick="addGallery()" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="gallery-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gallery</th>
                                    <th>Title</th>
                                    <th>Description</th>
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
                                    <th>Gallery</th>
                                    <th>Title</th>
                                    <th>Description</th>
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
<div class="modal fade" id="gallery-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
            <form id="form-gallery" method="POST" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                    <div id="pre" class="form-group">
                        {{-- <img src="{{ asset('/storage/web_assets/genbiUH.png') }}" width="200" class="img-thumbnail rounded mx-auto d-block" /> --}}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Gallery</label>
                        <input id="input-photo" type="file" class="form-control-file" id="image" name="image" onchange="readURL(this)" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
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
    let table = $('#gallery-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('gallery.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {
            data:'image', 
            name:'image',
            render: function (data, type, full, meta) {
                    return `<img src="{{ asset('/storage/gallery/${data}') }}" width="200" class="img-thumbnail rounded mx-auto d-block" />`;
                },
            "title": "Gallery",
            "orderable": true,
            "searchable": true
            },
            {data:'title', name:'title'},
            {data:'description', name:'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    function addGallery(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#gallery-form').modal('show');
        $('#pre').html('');
        $('#type-button').show();
        $('#input-photo').show();
        $('.form-control').removeAttr("readonly","");
        $('#gallery-form form')[0].reset();
        $('#input-photo').attr("required","");
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

    function viewGallery(id){
        $('#gallery-form form')[0].reset();
        $.ajax({
            type: "GET",
            url: "{{ url('administrator/gallery') }}" + '/' + id,
            dataType: "JSON",
            success: function(data){
                $('#gallery-form').modal('show');
                $('.modal-title').text('View Gallery');
                $('#type-button').hide();
                $('#input-photo').hide();
                $('.form-control').attr("readonly","");
                $('#pre').html(`<img src="{{ asset('/storage/gallery/${data.image}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#title').val(data.title)
                $('#description').val(data.description);
            },
            error: function(){
                swal({
                        title: 'Oops...',
                        text: 'Something when wrong!',
                        type: 'error',
                        time: '1500'
                })
            }
        });
    }

    function editGallery(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#gallery-form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/gallery') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#gallery-form').modal('show');
                $('.modal-title').text('Update Gallery');
                $('#type-button').text('Edit');
                $('#type-button').show();
                $('#input-photo').show();
                $('.form-control').removeAttr("readonly","");
                $('#pre').html(`<img src="{{ asset('/storage/gallery/${data.image}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#input-photo').removeAttr("required","");
                $('#title').val(data.title)
                $('#id').val(data.id);
                $('#description').val(data.description);
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

    function deleteGallery(id) {
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
                url: "{{ url('administrator/gallery') }}" + '/' + id,
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
        $('#gallery-form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#id').val();
                if (save_method == 'add') url = "{{ url('administrator/gallery') }}";
                else url = "{{ url('administrator/gallery') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#admin-form form').serialize(),
                    data: new FormData($("#gallery-form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        $('#gallery-form').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error : function(data){
                        $('#gallery-form').modal('hide');
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