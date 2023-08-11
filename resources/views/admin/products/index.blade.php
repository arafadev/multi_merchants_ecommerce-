@extends('admin.master')
@section('title', 'Products')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Products <span
                                class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('product.add') }}" class="btn btn-primary">Add Product</a>
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
                                <th>Product Name </th>
                                <th>Price </th>
                                <th>QTY </th>
                                <th>Discount </th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr data-id="{{ $item->id }}">
                                    <td> {{ $key + 1 }} </td>
                                    <td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height:40px;">
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->selling_price }}$</td>
                                    <td>{{ $item->product_qty }}</td>
                                    <td>
                                        @if ($item->discount_price == null)
                                            <span class="badge rounded-pill bg-info">No Discount</span>
                                        @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount / $item->selling_price) * 100;
                                            @endphp
                                            <span class="badge rounded-pill bg-danger"> {{ round($discount) }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ route('category.delete', $item->id) }}" class="btn btn-primary"
                                                title="Inactive"> <i class='bx bx-like'></i>
                                            </a>
                                        @else
                                            <a href="{{ route('category.delete', $item->id) }}" class="btn btn-primary"
                                                title="Active"> <i class='bx bx-dislike'></i> </a>
                                        @endif
                                    </td>

                                    <td>
                                        @if (Auth::user()->can('product.edit'))
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info"
                                                title="Edit Data">
                                                <i class='bx bx-pencil'></i>
                                            </a>
                                        @endif
                                        @if (Auth::user()->can('product.delete'))
                                            <a href="{{ route('category.delete', $item->id) }}"
                                                class="btn btn-danger delete-product" id="delete" title="Delete Data"
                                                data-url="{{ route('delete.product', $item->id) }}"
                                                data-id="{{ $item->id }}">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        @endif
                                        @if ($item->status == 1)
                                            <a href="{{ route('category.delete', $item->id) }}" class="btn btn-primary"
                                                title="Inactive">
                                                <i class='bx bx-dislike'></i>
                                            </a>
                                        @else
                                            <a href="{{ route('category.delete', $item->id) }}" class="btn btn-primary"
                                                title="Active">
                                                <i class='bx bx-like'></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <!-- Bootbox library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

    {{-- <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script> --}}
    <script>
        $(document).on('click', '.delete-product', function(e) {
            e.preventDefault();

            var product_id = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Product",
                message: "Are you sure you want to delete this product?",
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
                                $('a.delete-product[data-id="' + product_id + '"]').parents(
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
