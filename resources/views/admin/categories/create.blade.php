@extends('admin.master')
@section('title', 'Add Category')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Category </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <div id="validationErrors"></div>
                                <form id="myForm" method="POST" action="{{ route('category.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" />
                                        </div>


                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category Image </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="image" class="form-control" id="image" />
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                                style="width:100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>

                            </form>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        // store category
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault();

                // Get the form data
                var formData = new FormData(this);

                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // console.log(data);
                        toastr.success(data.message, 'Success');
                    },
                    error: function(xhr, status, error) {
                        var response = xhr.responseJSON;
                        if (response.hasOwnProperty('errors')) {
                            var errors = response.errors;
                            $.each(errors, function(field, messages) {
                                var input = $('input[name=' + field + ']');
                                input.addClass('is-invalid');
                                var errorDiv = input.next('.invalid-feedback');
                                if (!errorDiv.length) {
                                    input.after('<div class="invalid-feedback">' +
                                        messages.join('<br>') + '</div>');
                                } else {
                                    errorDiv.html(messages.join('<br>'));
                                }

                                input.on('input', function() {
                                    if ($(this).is(':valid')) {
                                        $(this).removeClass('is-invalid');
                                        $(this).next('.invalid-feedback')
                                            .remove();
                                    }
                                });
                            });
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    }
                });
            });
        });
    </script>
@endsection
