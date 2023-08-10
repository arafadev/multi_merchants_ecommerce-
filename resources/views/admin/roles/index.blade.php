@extends('admin.master')
@section('title', 'Roles')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Roles</div>
            <div class="ps-3">  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Roles</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('role.create') }}" class="btn btn-primary">Add Roles</a>
                </div>
            </div>
        </div>


        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Roles Name </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->name }}</td>

                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a class="btn btn-danger delete-role"
                                            data-url="{{ route('role.delete', $item->id) }}"
                                            data-id="{{ $item->id }}">Delete</a>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Roles Name </th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
@section('js')
    <!-- Bootbox library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script>
        $(document).on('click', '.delete-role', function(e) {
            e.preventDefault();

            var role = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete role",
                message: "Are you sure you want to delete this role?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-trash"></i> Remove'
                    }
                },
                callback: function(result) {
                    if (result) {
                        // Send the delete request
                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function(response) {
                                toastr.success(response.message);
                                // Remove the deleted row from the DataTable
                                $('a.delete-role[data-id="' + role + '"]').parents(
                                        'tr')
                                    .remove();
                            },
                            error: function(xhr, status, error) {
                                toastr.error(xhr.responseJSON.message);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
