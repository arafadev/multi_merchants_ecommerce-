<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">Ecommerce</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->can('brand.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    @if (Auth::user()->can('brand.list'))
                        <li> <a href="{{ route('brands') }}"><i class="bx bx-right-arrow-alt"></i>Brands</a>
                        </li>
                    @endif
                    <li> <a href="{{ route('brand.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand </a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <li> <a href="{{ route('categories') }}"><i class="bx bx-right-arrow-alt"></i>Categories</a>
                </li>
                {{-- <li> <a href="{{ route('category.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Category </a> --}}
        </li>

    </ul>
    </li>
    @if (Auth::user()->can('cat.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">SubCategories</div>
            </a>
            <ul>
                @if (Auth::user()->can('category.list'))
                    <li> <a href="{{ route('subcategories') }}"><i class="bx bx-right-arrow-alt"></i>SubCategories</a>
                    </li>
                @endif

                @if (Auth::user()->can('category.add'))
                    <li> <a href="{{ route('subcategory.add') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            SubCategory
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if (Auth::user()->can('product.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                @if (Auth::user()->can('product.list'))
                    <li> <a href="{{ route('products') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                    </li>
                @endif
                @if (Auth::user()->can('product.add'))
                    <li> <a href="{{ route('product.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                    </li>
                @endif


            </ul>
        </li>

    @endif
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Review Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('reviews.pending') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
            </li>

            <li> <a href="{{ route('reviews.publish') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>



        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Slider Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('sliders') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
            </li>
            <li> <a href="{{ route('slider.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
            </li>

        </ul>
    </li>


    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Blog Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog
                    Categroy</a>
            </li>

            <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>



        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Banner Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('banners') }}"><i class="bx bx-right-arrow-alt"></i>Banners</a>
            </li>
            <li> <a href="{{ route('banner.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Vendor Manage </div>
        </a>
        <ul>
            <li> <a href="{{ route('vendor.inactive') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
            </li>

            <li> <a href="{{ route('active.vendors') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
            </li>
        </ul>
    </li>



    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Order Manage </div>
        </a>
        <ul>
            <li> <a href="{{ route('order.pending') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
            </li>
            <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed
                    Order</a>
            </li>
            <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing
                    Order</a>
            </li>
            <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered
                    Order</a>
            </li>

        </ul>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Return Order </div>
        </a>
        <ul>
            <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Requests</a>
            </li>
            <li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete
                    Request</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Reports Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('reports.index') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
            </li>

            <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
            </li>

        </ul>
    </li>


    </li>


    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Coupon System</div>
        </a>
        <ul>
            <li> <a href="{{ route('coupons') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
            </li>
            <li> <a href="{{ route('coupon.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Shipping Area </div>
        </a>
        <ul>
            <li> <a href="{{ route('divisions') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
            </li>
            <li> <a href="{{ route('districts') }}"><i class="bx bx-right-arrow-alt"></i>All District</a>
            </li>

            <li> <a href="{{ route('states') }}"><i class="bx bx-right-arrow-alt"></i>All State</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Setting Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('site_settings.index') }}"><i class="bx bx-right-arrow-alt"></i>Site
                    Setting</a>
            </li>

            <li> <a href="{{ route('seos.index') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
            </li>


        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Stock Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('product_stock.index') }}"><i class="bx bx-right-arrow-alt"></i>Product
                    Stock</a>
            </li>
        </ul>
    </li>


    <li class="menu-label">Roles And Permission</li>
    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-line-chart"></i>
            </div>
            <div class="menu-title">Role & Permission</div>
        </a>
        <ul>
            <li> <a href="{{ route('permissions.index') }}"><i class="bx bx-right-arrow-alt"></i>Permissions</a>
            </li>
            <li> <a href="{{ route('roles.index') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>

            <li> <a href="{{ route('create.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles in
                    Permission</a>
            </li>

            <li> <a href="{{ route('permission_roles.index') }}"><i class="bx bx-right-arrow-alt"></i>All Roles
                    in
                    Permission</a>
            </li>
        </ul>
    </li>

    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-line-chart"></i>
            </div>
            <div class="menu-title">Admin Manage </div>
        </a>
        <ul>
            <li> <a href="{{ route('admins.index') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
            </li>
            <li> <a href="{{ route('admin.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
            </li>


        </ul>
    </li>

    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
            </div>
            <div class="menu-title">Components</div>
        </a>
        <ul>
            <li> <a href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i>Alerts</a>
            </li>
            <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
            </li>
            <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>Badges</a>
            </li>
            <li> <a href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Buttons</a>
            </li>
            <li> <a href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Cards</a>
            </li>
            <li> <a href="component-carousels.html"><i class="bx bx-right-arrow-alt"></i>Carousels</a>
            </li>
            <li> <a href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>List Groups</a>
            </li>
            <li> <a href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Media
                    Objects</a>
            </li>
            <li> <a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Modals</a>
            </li>
            <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Navs & Tabs</a>
            </li>
            <li> <a href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i>Navbar</a>
            </li>
            <li> <a href="component-paginations.html"><i class="bx bx-right-arrow-alt"></i>Pagination</a>
            </li>
            <li> <a href="component-popovers-tooltips.html"><i class="bx bx-right-arrow-alt"></i>Popovers &
                    Tooltips</a>
            </li>
            <li> <a href="component-progress-bars.html"><i class="bx bx-right-arrow-alt"></i>Progress</a>
            </li>
            <li> <a href="component-spinners.html"><i class="bx bx-right-arrow-alt"></i>Spinners</a>
            </li>
            <li> <a href="component-notifications.html"><i class="bx bx-right-arrow-alt"></i>Notifications</a>
            </li>
            <li> <a href="component-avtars-chips.html"><i class="bx bx-right-arrow-alt"></i>Avatrs &
                    Chips</a>
            </li>
        </ul>
    </li>



    </ul>
    <!--end navigation-->
</div>
