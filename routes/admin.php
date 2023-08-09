<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ActiveUserController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ActiveVendorController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ShippingAreaController;
use App\Http\Controllers\Admin\VendorManageController;
use App\Http\Controllers\Admin\ReturnRequestController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\SeoController;

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('admin.login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('change/password', [AdminProfileController::class, 'changePassword'])->name('admin.change.password');
    Route::post('update/password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.update.password');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    //  ======================================================= Brand Routes =============================================

    Route::get('brands', [BrandController::class, 'brands'])->name('brands');
    Route::get('brand/add', [BrandController::class, 'addBrand'])->name('brand.add');
    Route::post('brand/store', [BrandController::class, 'storeBrand'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
    Route::post('brand/update/{id}', [BrandController::class, 'updateBrand'])->name('brand.update');
    Route::get('brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
    Route::post('brand/store', [BrandController::class, 'storeBrand'])->name('brand.store');
    //  ======================================================= End Brand Routes =============================================

    //  ======================================================= Category Routes =============================================
    Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
    Route::get('category/add', [CategoryController::class, 'addCategory'])->name('category.add');
    Route::post('category/store', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::post('category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
    Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    //  ======================================================= End Category Routes =============================================

    //  ======================================================= SubCategory Routes =============================================
    Route::get('subcategories', [SubCategoryController::class, 'subcategories'])->name('subcategories');
    Route::get('subcategory/add', [SubCategoryController::class, 'addSubCategory'])->name('subcategory.add');
    Route::post('subcategory/store', [SubCategoryController::class, 'storeSubCategory'])->name('subcategory.store');
    Route::post('subcategory/update/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('subcategory.update');
    Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('subcategory.edit');
    Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');
    //  ======================================================= End SubCategory Routes =============================================

    //  ======================================================= Vendor Manage Routes =============================================
    Route::get('inactive/vendors', [VendorManageController::class, 'inactiveVendor'])->name('vendor.inactive');
    Route::get('/active/vendor/{id}', [VendorManageController::class, 'adminActiveVendor'])->name('admin.active.vendor');
    Route::get('active/vendors/', [VendorManageController::class, 'activeVendors'])->name('active.vendors');
    Route::get('/active/vendor/details/{id}', [VendorManageController::class, 'activeVendorDetails'])->name('active.vendor.details');
    Route::get('/inactive/vendor/{id}', [VendorManageController::class, 'adminInactiveVendor'])->name('admin.inactive.vendor');
    //  ======================================================= End Vendor Manage Routes =============================================

    //  ======================================================= Products Routes ===================================================
    Route::get('products', [ProductController::class, 'products'])->name('products');
    Route::get('product/add', [ProductController::class, 'addProduct'])->name('product.add');
    Route::post('product/store', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('subcategory/ajax/{category_id}', [ProductController::class, 'getSubcategory']);
    Route::get('product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::post('/product/thumbnail/update', [ProductController::class, 'updateProductThumbnail'])->name('update.product.thumbnail');
    Route::post('/update/product/multiImag',  [ProductController::class, 'UpdateProductMultiImage'])->name('update.product.multiimage');
    Route::get('/product/multiImage/delete/{id}',  [ProductController::class, 'deleteProductMultiImage'])->name('delete.product.multiimage');
    Route::get('/product/delete/{id}',  [ProductController::class, 'deleteProduct'])->name('delete.product');


    // For Product Stock
    Route::get('/product/stock', [ProductController::class, 'productStock'])->name('product_stock.index');
    //  ======================================================= End Product Routes =============================================
    //  ======================================================= Sliders Routes =============================================
    Route::get('sliders', [SliderController::class, 'sliders'])->name('sliders');
    Route::get('slider/add', [SliderController::class, 'addSlider'])->name('slider.add');
    Route::post('slider/store', [SliderController::class, 'storeSlider'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'editSlider'])->name('slider.edit');
    Route::post('slider/update/{id}', [SliderController::class, 'updateSlider'])->name('slider.update');
    Route::get('slider/delete/{id}', [SliderController::class, 'deleteSlider'])->name('slider.delete');
    //  ======================================================= End Slider Routes =============================================
    //  ======================================================= Banners Routes =============================================
    Route::get('banners', [BannerController::class, 'banners'])->name('banners');
    Route::get('banner/add', [BannerController::class, 'addBanner'])->name('banner.add');
    Route::post('banner/store', [BannerController::class, 'storeBanner'])->name('banner.store');
    Route::get('banner/edit/{id}', [BannerController::class, 'editBanner'])->name('banner.edit');
    Route::post('banner/update/{id}', [BannerController::class, 'updateBanner'])->name('banner.update');
    Route::get('banner/delete/{id}', [BannerController::class, 'deleteBanner'])->name('banner.delete');
    //  ======================================================= End banner Routes =============================================
    //  ======================================================= Banners Routes =============================================
    Route::get('coupons', [CouponController::class, 'coupons'])->name('coupons');
    Route::get('coupon/add', [CouponController::class, 'addCoupon'])->name('coupon.add');
    Route::post('coupon/store', [CouponController::class, 'storeCoupon'])->name('coupon.store');
    Route::get('coupon/edit/{id}', [CouponController::class, 'editCoupon'])->name('coupon.edit');
    Route::post('coupon/update', [CouponController::class, 'updateCoupon'])->name('coupon.update');
    Route::get('coupon/delete/{id}', [CouponController::class, 'deleteCoupon'])->name('coupon.delete');
    //  ======================================================= End banner Routes =============================================

    // Shipping Division All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('divisions', [ShippingAreaController::class, 'divisions'])->name('divisions');
        Route::get('/add/division', [ShippingAreaController::class, 'addDivision'])->name('division.add');
        Route::post('/store/division', [ShippingAreaController::class, 'storeDivision'])->name('division.store');
        Route::get('/edit/division/{id}', [ShippingAreaController::class, 'editDivision'])->name('division.edit');
        Route::post('/update/division/{id}', [ShippingAreaController::class, 'updateDivision'])->name('division.update');
        Route::delete('/delete/division/{id}', [ShippingAreaController::class, 'deleteDivision'])->name('division.delete');
    });
    // Shipping District All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/districts', 'districts')->name('districts');
        Route::get('/add/district', 'addDistrict')->name('district.add');
        Route::post('/store/district', 'storeDistrict')->name('district.store');
        Route::get('/edit/district/{id}', 'editDistrict')->name('district.edit');
        Route::post('/update/district/{id}', 'updateDistrict')->name('district.update');
        Route::delete('/delete/district/{id}', 'deleteDistrict')->name('district.delete');
    });
    // Shipping State All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('states', 'states')->name('states');
        Route::get('/add/state', 'addState')->name('state.add');
        Route::post('/store/state', 'storeState')->name('state.store');
        Route::get('/edit/state/{id}', 'editState')->name('state.edit');
        Route::post('/update/state/{id}', 'updateState')->name('state.update');
        Route::delete('/delete/state/{id}', 'deleteState')->name('state.delete');
        Route::get('/district/ajax/{division_id}', 'getDistrict');
    });

    // Admin Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('pending/order', 'pendingOrder')->name('order.pending');
        Route::get('order/details/{order_id}', 'orderDetails')->name('admin.order.details');

        Route::get('confirmed/order', 'confirmedOrder')->name('admin.confirmed.order');
        Route::get('processing/order', 'processingOrder')->name('admin.processing.order');
        Route::get('delivered/order', 'deliveredOrder')->name('admin.delivered.order');
        Route::get('pending/confirm/{order_id}', 'pendingToConfirm')->name('pending-confirm');
        Route::get('confirm/processing/{order_id}', 'confirmToProcess')->name('confirm-processing');
        Route::get('processing/delivered/{order_id}', 'processToDelivered')->name('processing-delivered');
        Route::get('invoice/download/{order_id}', 'invoiceDownload')->name('admin.invoice.download');
    });

    // Return Order All Route
    Route::controller(ReturnRequestController::class)->group(function () {
        Route::get('return/request', 'returnRequest')->name('return.request');
        Route::get('return/request/approved/{order_id}', 'returnRequestApproved')->name('return.request.approved');
        Route::get('complete/return/request', 'completeReturnRequest')->name('complete.return.request');
    });

    // Report All Route
    Route::controller(ReportController::class)->group(function () {

        Route::get('reports', 'reports')->name('reports.index');
        Route::post('search/by/date', 'searchByDate')->name('search-by-date');
        Route::post('search/by/month', 'searchByMonth')->name('search-by-month');
        Route::post('search/by/year', 'searchByYear')->name('search-by-year');
        Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');
        Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
        Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');
    });

    // Active user and vendor All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('blog/category', 'allBlogCategory')->name('admin.blog.category');

        Route::get('add/blog/category', 'addBlogCategory')->name('add.blog.category');

        Route::post('store/blog/category', 'storeBlogCategory')->name('store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'editBlogCategory')->name('edit.blog.category');
        Route::post('/admin/update/blog/category', 'updateBlogCategory')->name('update.blog.category');
        Route::get('/admin/delete/blog/category/{id}', 'deleteBlogCategory')->name('delete.blog.category');
    });

    // Blog Post All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('blog/post', 'allBlogPost')->name('admin.blog.post');

        Route::get('add/blog/post', 'addBlogPost')->name('add.blog.post');

        Route::post('store/blog/post', 'storeBlogPost')->name('store.blog.post');
        Route::get('edit/blog/post/{id}', 'editBlogPost')->name('edit.blog.post');

        Route::post('update/blog/post', 'UpdateBlogPost')->name('update.blog.post');

        Route::get('delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
    });

    //  Reviews All Routes
    Route::controller(ReviewController::class)->group(function () {
        Route::get('pending/review', 'pendingReview')->name('reviews.pending');
        Route::get('review/approve/{id}', 'reviewApprove')->name('review.approve');
        Route::get('publish/reviews', 'publishReview')->name('reviews.publish');
        Route::get('review/delete/{id}', 'reviewDelete')->name('review.delete');
    });

    // Site Setting All Routes
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site/setting', 'siteSetting')->name('site_settings.index');
        Route::post('/site/setting/update', 'siteSettingUpdate')->name('site_setting.update');
    });

    // Seos Setting All Routes
    Route::controller(SeoController::class)->group(function () {
        Route::get('seo/setting', 'seos')->name('seos.index');
        Route::post('seo/setting/update', 'seoSettingUpdate')->name('seo.setting.update');
    });
});
