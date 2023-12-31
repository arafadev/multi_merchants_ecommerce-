@extends('admin.master')
@section('title', 'Add Coupon')
@section('content')


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Coupon </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Coupon </li>
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

                            <form method="post" action="{{ route('coupon.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="coupon_name" class="form-control"
                                            value="{{ old('coupon_name') }}" />
                                        <div style="color: red">
                                            @error('coupon_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Discount(%)</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="number" name="coupon_discount" class="form-control"
                                            value="{{ old('coupon_discount') }}" />
                                        <div style="color: red">
                                            @error('coupon_discount')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Coupon Validity</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="date" name="coupon_validity" class="form-control"
                                            value="{{ old('coupon_validity') }}"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                        <div style="color: red">
                                            @error('coupon_validity')
                                                {{ $message }}
                                            @enderror
                                        </div>
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
@endsection
