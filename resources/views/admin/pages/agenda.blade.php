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
                                <button type="button" class="btn btn-outline-primary" onclick="addAgenda()"> <i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="agenda-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Agenda Head</th>
                                    <th>Agenda Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Agenda Head</th>
                                    <th>Agenda Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
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
<div class="modal fade" id="agenda_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agenda" method="POST" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-body">
                    <input type="hidden" id='id' name='id'>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Agenda Head:</label>
                            <input type="text" class="form-control" name="agenda_head" id="agenda_head" required>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Agenda Description:</label>
                            <input type="text" class="form-control" name="agenda_description" id="agenda_description" required>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">End Date:</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required>
                            <span class="help-block with-errors text-danger"></span>
                        </div>
                    </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button id="type_button" type="submit" class="btn btn-outline-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
    let table = $('#agenda-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('agenda.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {data:'agenda_head', name:'agenda_head'},
            {data:'agenda_description', name:'agenda_description'},
            {data:'start_date', name:'start_date'},
            {data:'end_date', name:'end_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    function addAgenda(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#agenda_form').modal('show');
        $('#type-button').show();
        $('#agenda_form form')[0].reset();
        $('.modal-title').text('Add Agenda');
        $('#type-button').text('Add');
        $('.form-control').removeAttr("readonly","");
    }

    function viewAgenda(id){
        $('#agenda_form form')[0].reset();
        $.ajax({
            type: "GET",
            url: "{{ url('administrator/agenda') }}" + '/' + id,
            dataType: "JSON",
            success: function(data){
                $('#agenda_form').modal('show');
                $('.modal-title').text('View Agenda ');
                $('#type-button').hide();
                
                $('#agenda_head').val(data.agenda_head);
                $('#agenda_description').val(data.agenda_description);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
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

    function editAgenda(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#agenda_form form')[0].reset();
        $.ajax({
            url: "{{ url('administrator/agenda') }}" + '/' + id + '/edit',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#agenda_form').modal('show');
                $('.modal-title').text('Update Agenda ');
                $('#type-button').text('Edit');
                $('#type-button').show();
                $('.form-control').removeAttr("readonly","");
                $('#id').val(data.id);
                $('#agenda_head').val(data.agenda_head);
                $('#agenda_description').val(data.agenda_description);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
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

    function deleteAgenda(id) {
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
                url: "{{ url('administrator/agenda') }}" + '/' + id,
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
        $('#agenda_form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#id').val();
                if (save_method == 'add') url = "{{ url('administrator/agenda') }}";
                else url = "{{ url('administrator/agenda') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    // data : $('#admin-form form').serialize(),
                    data: new FormData($("#agenda_form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        $('#agenda_form').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        }).catch(swal.noop);
                    },
                    error : function(data){
                        $('#agenda_form').modal('hide');
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