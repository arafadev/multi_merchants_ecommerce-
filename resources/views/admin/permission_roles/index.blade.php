@extends('admin.master')
@section('title', 'Roles & Permission')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Roles Premission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Roles Premission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

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
                                <th>Roles Name </th>
                                <th>Permission </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->permissions as $perm)
                                            <span class="badge rounded-pill bg-danger"> {{ $perm->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.role.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- <a href="{{ route('admin.delete.roles', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a> --}}

                                        <a class="btn btn-danger delete-permission_role"
                                            data-url="{{ route('admin.delete.roles', $item->id) }}"
                                            data-id="{{ $item->id }}">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Roles Name </th>
                                <th>Permission </th>
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

        $(document).on('click', '.delete-permission_role', function(e) {
            e.preventDefault();

            var permission_role = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Role With Permission",
                message: "Are you sure you want to delete this Permission?",
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

                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function(response) {
                                toastr.success(response.message);

                                $('a.delete-permission_role[data-id="' + permission_role + '"]').parents(
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
