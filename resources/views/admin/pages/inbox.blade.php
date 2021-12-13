@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="inbox-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Message</th>
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

{{-- Modal Update Data --}}
<div class="modal fade" id="inbox-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inbox</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id='id' name='id'>
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" readonly="readonly" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" readonly="readonly" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone Number:</label>
                        <input type="text" class="form-control" readonly="readonly" name="phone_number" id="phone_number">
                    </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Message:</label>
                            <textarea type="text" class="form-control" readonly="readonly" name="message_content" id="message_content"></textarea>
                        </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('ajax')
    <script type="text/javascript">
        let table = $('#inbox-table').DataTable({
            processing : true,
            serverSide : true,
            "responsive": true,
            "autoWidth": false,
            ajax : "{{ route('inbox.index') }}",
            columns : [
                {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
                },
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'message_content', name: 'message_content'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function viewInbox(id){
            $('#inbox-form form')[0].reset();
            $.ajax({
                type: "GET",
                url: "{{ url('administrator/inbox') . '/' }}" + id,
                dataType: "JSON",
                success: function (response) {
                    $('#inbox-form').modal('show'),
                    $('#name').val(response.name)
                    $('#email').val(response.email)
                    $('#phone_number').val(response.phone_number)
                    $('#message_content').val(response.message_content)
                },
                error: function(){

                }
            });
        }

        function deleteInbox(id){
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
                url: "{{ url('administrator/inbox') }}" + '/'  + id,
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
    </script>
@endsection