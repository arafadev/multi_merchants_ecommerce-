@php
    $status = App\Models\Vendor::find(Auth::id())->status;
@endphp


<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('vendor.dashboard') }}">
                <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            </a>
        </div>
        <div>
            <a href="{{ route('vendor.dashboard') }}">
                <h4 class="logo-text">Vendor</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        @if ($status === 'active')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Product Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.products') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                    </li>
                    <li> <a href="{{ route('vendor.product.add') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Product</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title"> Order Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.orders') }}"><i class="bx bx-right-arrow-alt"></i>
                            Orders</a>
                    </li>
                    <li> <a href="{{ route('vendor.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Return
                            Order</a>
                    </li>
                    <li> <a href="{{ route('vendor.complete.return.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Complete Return Order</a>
                    </li>

                </ul>
            </li>


            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title"> Review Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('reviews.index') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                    </li>



                </ul>
            </li>
        @endif




        <li>
            <a href=" " target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
