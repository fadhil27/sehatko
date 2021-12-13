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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Testimony</th>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Testimony</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Testimony</h5>
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
                        <label for="recipient-name" class="col-form-label">Photo</label>
                        <input id="input-photo" type="file" class="form-control-file" id="photo" name="photo" onchange="readURL(this)" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Testimony</label>
                        <input type="text" class="form-control" id="testi" name="testi" required>
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
        ajax : "{{ route('testimony.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {
            data:'photo', 
            name:'photo',
            render: function (data, type, full, meta) {
                    return `<img src="{{ asset('/storage/testimony/${data}') }}" width="200" class="img-thumbnail rounded mx-auto d-block" />`;
                },
            "title": "Photo",
            "orderable": true,
            "searchable": true
            },
            {data:'name', name:'name'},
            {data:'testi', name:'testi'},
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
        $('.modal-title').text('Add Testimony');
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
            url: "{{ url('administrator/testimony') }}" + '/' + id,
            dataType: "JSON",
            success: function(data){
                $('#gallery-form').modal('show');
                $('.modal-title').text('View Testimony');
                $('#type-button').hide();
                $('#input-photo').hide();
                $('.form-control').attr("readonly","");
                $('#pre').html(`<img src="{{ asset('/storage/testimony/${data.photo}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#name').val(data.name)
                $('#testi').val(data.testi);
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
            url: "{{ url('administrator/testimony') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#gallery-form').modal('show');
                $('.modal-title').text('Update Gallery');
                $('#type-button').text('Edit');
                $('#type-button').show();
                $('#input-photo').show();
                $('.form-control').removeAttr("readonly","");
                $('#pre').html(`<img src="{{ asset('/storage/testimony/${data.photo}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#input-photo').removeAttr("required","");
                $('#name').val(data.name)
                $('#id').val(data.id);
                $('#testi').val(data.testi);
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
                url: "{{ url('administrator/testimony') }}" + '/' + id,
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
                if (save_method == 'add') url = "{{ url('administrator/testimony') }}";
                else url = "{{ url('administrator/testimony') . '/' }}" + id;

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