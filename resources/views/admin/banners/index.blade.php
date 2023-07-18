@extends('admin.master')
@section('title', 'Banner')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"> Bannes</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Banners</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('banner.add') }}" class="btn btn-primary">Add Banner</a>


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
                                <th>Banner Title </th>
                                <th>Banner Url </th>
                                <th>Banner Image </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->banner_title }}</td>
                                    <td>{{ $item->banner_url }}</td>
                                    <td> <img src="{{ asset($item->banner_image) }}" style="width: 70px; height:40px;">
                                    </td>

                                    <td>
                                        <a href="{{ route('banner.edit', $item->id) }}" class="btn btn-info">Edit</a>

                                        <a class="btn btn-danger delete-banner"
                                            data-url="{{ route('banner.delete', $item->id) }}"
                                            data-id="{{ $item->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Banner Name </th>
                                <th>Banner Image </th>
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

    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!-- Bootbox library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <!--Datatable-->
    <script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script>
        // Datatable
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).on('click', '.delete-banner', function(e) {
            e.preventDefault();

            var banner_id = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Banner",
                message: "Are you sure you want to delete this Banner?",
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
                                $('a.delete-banner[data-id="' + banner_id + '"]').parents(
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
