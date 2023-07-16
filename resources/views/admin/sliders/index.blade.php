@extends('admin.master')
@section('title', 'Sliders')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"> Sliders</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sliders</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('slider.add') }}" class="btn btn-primary">Add Slider</a>


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
                                <th>Slider Title </th>
                                <th>Short Title </th>
                                <th>Slider Image </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td>{{ $item->slider_title }}</td>
                                    <td>{{ $item->short_title }}</td>
                                    <td> <img src="{{ asset($item->slider_image) }}" style="width: 70px; height:40px;">
                                    </td>

                                    <td>
                                        <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-info">Edit</a>

                                        <a class="btn btn-danger delete-slider"
                                            data-url="{{ route('slider.delete', $item->id) }}"
                                            data-id="{{ $item->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Brand Name </th>
                                <th>Brand Image </th>
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

        $(document).on('click', '.delete-slider', function(e) {
            e.preventDefault();

            var slider_id = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Slider",
                message: "Are you sure you want to delete this Slider?",
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
                                $('a.delete-slider[data-id="' + slider_id + '"]').parents(
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
