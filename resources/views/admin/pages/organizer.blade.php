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
                                <button id="add-button" onclick="addOrganizer()" type="button" class="btn btn-outline-primary"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="organizer-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th> Presidium Name / Division Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Presidium Name / Division Name</th>
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
<div class="modal fade" id="organizer-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Core Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="overflow-y: scroll;">
            <form action="" id="form-organizer" method="POST" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category</label>
                        <select id="dropDown" class="form-control" id="exampleFormControlSelect1" name="team_category" required>
                            <option value="presidium">Presidium</option>
                            <option value="division">Division</option>
                        </select>
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group" id="pre">
                        {{-- <img id="preview" width="200" class="img-thumbnail rounded mx-auto d-block" /> --}}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Photo</label>
                        <input class="form-control-file" id="input-photo" type="file" name="photo" id="photo" onchange="readURL(this)">
                        <input class="form-control-file pt-2" id="input-photo2" type="file" name="photo2" id="photo2">
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <span class="help-block with-errors text-danger" id="warning-upload">Kosong pilihan file jika tidak ingin di ubah!</span>
                    <div class="form-group" id="input-name">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group" id="input-position">
                        <label for="recipient-name" class="col-form-label">Position</label>
                        <input type="text" class="form-control" name="position" id="position">
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group" id="input-email">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <span class="help-block with-errors text-danger"></span>
                    </div>
                    <div class="form-group" id="input-instagram">
                        <label for="recipient-name" class="col-form-label">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram">
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

    function rulesSelector() {
        var selectedOption = $('#dropDown :selected').val();
        var form = $("#organizer-form form");

        if(selectedOption === 'presidium') {
            form.find('#input-position, #input-instagram, #input-email').show();
            form.find(':input[id="input-photo2"]').hide();
        }else if(selectedOption === 'division') {
            form.find('#input-position, #input-instagram, #input-email', ':input #photo2').hide();
            form.find(':input[id="input-photo2"]').show();
        }
    }

    let table = $('#organizer-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('organizer.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {data:'name', name:'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    function addOrganizer(){
        $('#organizer-form form')[0].reset();
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#organizer-form').modal('show');
        $('#warning-upload').hide();
        $('#pre').html('');
        $('#type-button').show();
        $('#input-photo').show();
        $('#organizer-form form')[0].reset();
        $('#input-photo').attr("required","");
        $('.form-control').removeAttr("readonly","");
        $('.modal-title').text('Add Core Team');
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

    function viewOrganizer(id){
        $('#organizer-form form')[0].reset();
        $.ajax({
            type: "GET",
            url: "{{ url('administrator/organizer') }}" + '/' + id,
            dataType: "JSON",
            success: function(data){
                $('#organizer-form').modal('show');
                $('.modal-title').text('View Organizer');
                $('#type-button').hide();
                $('#input-photo').hide();
                $('#warning-upload').show();
                $('.form-control').attr("readonly","");
                $('#pre').html(`<img src="{{ asset('/storage/organizer/${data.photo}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#name').val(data.name);
                $('#position').val(data.position);
                $('#instagram').val(data.instagram);
                $('#email').val(data.email);
                $('div.form-group select').val(data.team_category);

                rulesSelector();
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

    function editOrganizer(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#organizer-form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/organizer') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#organizer-form').modal('show');
                $('.modal-title').text('Update Organizer');
                $('#type-button').text('Edit');
                $('#type-button').show();
                $('#input-photo').show();
                $('#warning-upload').show();
                $('#pre').html(`<img src="{{ asset('/storage/organizer/${data.photo}') }}" width='200' class='img-thumbnail rounded mx-auto d-block' />`)
                $('#input-photo').removeAttr("required","");
                $('.form-control').removeAttr("readonly","");
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#position').val(data.position);
                $('#instagram').val(data.instagram);
                $('#email').val(data.email);
                $('div.form-group select').val(data.team_category);
                
                rulesSelector();
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

    function deleteOrganizer(id) {
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
                url: "{{ url('administrator/organizer') }}" + '/' + id,
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
        $('#organizer-form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#id').val();
                if (save_method == 'add') url = "{{ url('administrator/organizer') }}";
                else url = "{{ url('administrator/organizer') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#admin-form form').serialize(),
                    data: new FormData($("#organizer-form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        $('#organizer-form').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error : function(data){
                        $('#organizer-form').modal('hide');
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

    $('#input-photo2').hide();
    $('#dropDown').on('change', function() {
        rulesSelector();
    });

    $('#organizer-form').on("show.bs.modal", function() {
        rulesSelector();
    });
</script>
@endsection