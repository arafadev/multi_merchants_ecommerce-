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
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('brands') }}"><i class="bx bx-right-arrow-alt"></i>Brands</a>
                </li>
                <li> <a href="{{ route('brand.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand </a>
                </li>

            </ul>
        </li>
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
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">SubCategories</div>
        </a>
        <ul>
            <li> <a href="{{ route('subcategories') }}"><i class="bx bx-right-arrow-alt"></i>SubCategories</a>
            </li>
            <li> <a href="{{ route('subcategory.add') }}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory </a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Product Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('products') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
            </li>
            <li> <a href="{{ route('product.add') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
            </li>

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
