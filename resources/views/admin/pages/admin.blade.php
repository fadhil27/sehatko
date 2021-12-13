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
                                <a type="button" class="btn btn-outline-primary" onclick="addAdmin()"> <i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="admin-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Last Login</th>
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
<div class="modal fade" id="admin-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-admin" method="post" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                        <input type="hidden" id='id' name='id'>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" autofocus required>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Role:</label>
                            <select class="form-control" name="role" id="role" required>
                                <option value="administrator">Administrator</option>
                                <option value="operator">Operator</option>
                            </select>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <span class="help-block with-errors text-danger"></span>
                            <p class="text-danger" id="pw"></p>
                        </div>
                        {{-- <div class="form-group">
                            <label for="recipient-name" class="col-form-label">New Password Confirmation:</label>
                            <input type="text" class="form-control" name="password_confirmation" required>
                            <span class="help-block with-errors text-danger"></span>
                        </div> --}}
                    </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary" id='type-button'></button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Data --}}
{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are You Sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('ajax')
<script type="text/javascript">
    let table = $('#admin-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('admin.index') }}",
        columns : [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {data: 'username', name: 'username'},
            {data: 'role', name: 'role'},
            {data: 'last_login_at', name: 'last_login_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function addAdmin(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#admin-form').modal('show');
        $('#admin-form form')[0].reset();
        $('.modal-title').text('Add Admin');
        $('#type-button').text('Add');
        $('#pw').text("");
        $('#password').attr("required","");
    }

    function editAdmin(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#admin-form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/admin') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#admin-form').modal('show');
                $('.modal-title').text('Edit Admin');
                $('#type-button').text('Edit');

                $('#pw').text("leave blank if you don't want to change");
                $('#password').removeAttr("required","");
                $('#id').val(data.id);
                $('#username').val(data.username);
                $('#role').val(data.role);
            },
            error: function(){
                swal({
                        title: 'Oops...',
                        text: 'Something when wrong!',
                        type: 'error',
                        timer: '1500'
                }).catch(swal.noop);
            }
        });
    }

    function deleteAdmin(id){
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
                url: "{{ url('administrator/admin') }}" + '/'  + id,
                data: {'_method' : 'DELETE', '_token' : csrf_token},
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
            $('#admin-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('administrator/admin') }}";
                    else url = "{{ url('administrator/admin') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        // data : $('#admin-form form').serialize(),
                        data: new FormData($("#admin-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#admin-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            }).catch(swal.noop);
                        },
                        error : function(data){
                            $('#admin-form').modal('hide');
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