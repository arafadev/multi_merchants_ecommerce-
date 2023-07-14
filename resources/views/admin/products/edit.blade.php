@extends('admin.master')
@section('title', 'Edit Product')
@section('css')
    <link href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
@section('content')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr />

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="myForm" method="post" action="{{ route('product.update', $product->id) }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" value="{{ $product->product_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $product->product_tags }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $product->product_size }} ">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $product->product_color }}">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea name="short_desc" class="form-control" id="inputProductDescription" rows="3">
                                         {{ $product->short_desc }}
			                        	</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_desc">
				                     {!! $product->long_desc !!}</textarea>
                                    </div>






                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                value="{{ $product->selling_price }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price </label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" value="{{ $product->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $product->product_code }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" value="{{ $product->product_qty }}">
                                        </div>


                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Product SubCategory</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $product->subcategory_id == $subcat->id ? 'selected' : '' }}>
                                                        {{ $subcat->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($activeVendor as $vendor)
                                                    <option value="{{ $vendor->id }}"
                                                        {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                        {{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12">

                                            <div class="row g-3">

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1"
                                                            id="flexCheckDefault"{{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault"> Hot
                                                            Deals</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1"
                                                            id="flexCheckDefault"{{ $product->featured == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>




                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1"
                                                            id="flexCheckDefault"{{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offer</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1"
                                                            id="flexCheckDefault"{{ $product->special_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>



                                            </div> <!-- // end row  -->

                                        </div>

                                        <hr>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary px-4"
                                                    value="Save Changes" />


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
            </div>

            </form>

        </div>

    </div>

    <!-- /// Main Image Thambnail Update ////// -->

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Main Image Thambnail </h6>
        <hr>
        <div class="card">
            <form method="post" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="old_img"
                    value="{{ asset('upload/product_thumbnail/' . $product->product_thumbnail) }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose Thumbnail Image</label>
                        <input name="product_thumbnail" class="form-control" type="file" id="formFile"
                            onchange="mainThamUrl(this)" required>
                        <div id="image-preview" style="display:none;">
                            <img id="mainThmb" style="margin-top: 10px; width: 80px; height: 80px;" />
                        </div>
                    </div>

                    <div class="mb-3" id="existing-image"
                        style="display: {{ $product->product_thumbnail ? 'block' : 'none' }};">
                        <label for="formFile" class="form-label"></label>
                        <div style="display: flex; align-items: flex-start;">
                            <img src="{{ asset('upload/product_thumbnail/' . $product->product_thumbnail) }}"
                                style="width:100px; height:100px; margin-right: 10px;">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                </div>

            </form>

        </div>
    </div>


    <!-- /// End Main Image Thambnail Update ////// -->

    <!-- /// Update Multi Image  ////// -->
    @if (count($product->multiImages))
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Multi Image </h6>
            <hr>
            <div class="card">
                <div class="card-body">


                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#Sl</th>
                                <th scope="col">Image</th>
                                <th scope="col">Change Image </th>
                                <th scope="col">Delete </th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="{{ route('update.product.multiimage') }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @csrf

                                <table class="table mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#Sl</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Change Image </th>
                                            <th scope="col">Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($multiImgs as $key => $img)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td><img src="{{ asset('upload/product_multi_imgs/' . $img->photo_name) }}"
                                                        style="width:70; height: 40px;">
                                                </td>
                                                <td><input type="file" class="form-group"
                                                        name="multi_img[{{ $img->id }}]"></td>
                                                <td>
                                                    <a class="btn btn-danger delete-multi-img"
                                                        data-url="{{ route('delete.product.multiimage', $img->id) }}"
                                                        data-id="{{ $img->id }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-primary px-4 mt-3" value="Update Images" />
                            </form>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endif
    <!-- /// End Update Multi Image  ////// -->





@endsection

@section('js')
    <!-- Bootbox library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

    <script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result);
                    $('#image-preview').show();
                    $('#existing-image').hide();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/admin/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.delete-multi-img', function(e) {
            e.preventDefault();

            var img_id = $(this).data('id');
            var url = $(this).data('url');

            // Show a confirmation dialog to confirm the delete action
            bootbox.confirm({
                title: "Delete Brand",
                message: "Are you sure you want to delete this brand?",
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
                                $('a.delete-multi-img[data-id="' + img_id + '"]').parents(
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
