@extends('admin.master')
@section('title', 'All Admins')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Admin User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Admin User</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.create') }}" class="btn btn-primary">Add Admin User</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image </th>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Phone </th>
                                <th>Role </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> <img
                                            src="{{ !empty($item->photo) && $item->photo != 'upload/no_image.jpg' ? url($item->photo) : url('upload/no_image.jpg') }}"
                                            class="user-img" alt="user avatar"> </td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @foreach ($item->roles as $role)
                                            <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        <a class="btn btn-danger delete-admin"
                                            data-url="{{ route('delete.admin.role', $item->id) }}"
                                            data-id="{{ $item->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Image </th>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Phone </th>
                                <th>Role </th>
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
    <!--Datatable-->
    <script>
        // Datatable
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).on('click', '.delete-admin', function(e) {
            e.preventDefault();

            var admin_id = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Admin",
                message: "Are you sure you want to delete this admin?",
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
                                $('a.delete-admin[data-id="' + admin_id + '"]')
                                    .parents(
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
