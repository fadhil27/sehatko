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
                                <button onclick="addCategory()" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="category-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Binding</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Binding</th>
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
<div class="modal fade" id="category_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cetegory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-category" method="POST" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Category:</label>
                            <input id="category_name" name="category_name" type="text" class="form-control">
                        </div>
                        <div class="form-group" id="binding">
                            
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
    let table = $('#category-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('category.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {data:'category_name', name:'category_name'},
            {data:'binding', name:'binding'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    function addCategory(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#category_form').modal('show');
        $('#type-button').show();
        $('#category_form form')[0].reset();
        $('.modal-title').text('Add Agenda');
        $('#type-button').text('Add');
        $('#binding').empty();
        $('.form-control').removeAttr("readonly","");
    }

    function viewCategory(id){
        $('#category_form form')[0].reset();
        $.ajax({
            type: "GET",
            url: "{{ url('administrator/category') }}" + '/' + id,
            dataType: "JSON",
            success: function(data){
                $('#category_form').modal('show');
                $('.modal-title').text('View Category');
                $('#type-button').hide();
                
                $('#category_name').val(data.category.category_name);
                $('#binding').html(`
                    <label for="recipient-name" class="col-form-label">Binding:</label>
                    <input id="binding" name="binding" type="text" class="form-control" value="${data.category.binding}">
                `);
                $('.form-control').attr("readonly","");

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

    function editCategory(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#category_form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/category') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#category_form').modal('show');
                $('.modal-title').text('Update Category');
                $('#type-button').text('Edit');
                $('#type-button').show();
                $('.form-control').removeAttr("readonly","");
                $('#id').val(data.category.id);
                $('#category_name').val(data.category.category_name);
                $('#binding').empty();
            },
            error: function () {
                swal({
                        title: 'Oops...',
                        text: 'Something when wrong!',
                        type: 'error',
                        time: '1500'
                })
            }
        });
    }

    function deleteCategory(id) {
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
                url: "{{ url('administrator/category') }}" + '/' + id,
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (data) {
                    table.ajax.reload();
                    swal({
                        title: data.title,
                        text: data.message,
                        type: data.type,
                        timer: '1500'
                    }).catch(swal.noop);
                },
                error: function () {
                    swal({
                        title: data.title,
                        text: 'Something when wrong!',
                        type: 'error',
                        timer: '1500'
                    }).catch(swal.noop);
                }
            });
        })
    }

    $(function(){
        $('#category_form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#id').val();
                if (save_method == 'add') url = "{{ url('administrator/category') }}";
                else url = "{{ url('administrator/category') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#admin-form form').serialize(),
                    data: new FormData($("#category_form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        $('#category_form').modal('hide');
                        table.ajax.reload(null, false);
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error : function(data){
                        $('#category_form').modal('hide');
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