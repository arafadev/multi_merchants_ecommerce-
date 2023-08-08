<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CashController;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\StripeController;
use App\Http\Controllers\Site\CompareController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\WishlistController;
use App\Http\Controllers\Site\User\UserProfileController;
use App\Http\Controllers\Site\User\UserDashboardController;
use App\Http\Controllers\Site\Vendor\Auth\VendorController;
use App\Http\Controllers\Site\User\Auth\UserLoginController;
use App\Http\Controllers\Site\User\Auth\UserRegisterController;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [IndexController::class, 'home']);
    Route::get('vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor.details');
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
    Route::get('register', [UserRegisterController::class, 'getRegister'])->name('user.register.form');
    Route::post('register', [UserRegisterController::class, 'register'])->name('user.register');

    //  Become Vendor Routes
    Route::get('become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
    Route::post('become/vendor', [VendorController::class, 'becomeVendorRegister'])->name('become_vendor.register');
    Route::post('all/vendor', [VendorController::class, 'allVendor'])->name('vendor.all');

    // Categories with products
    Route::get('/product/category/{id}/{slug}', [IndexController::class, 'catWithProducts']);
    Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);
    Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

    // // Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);
    Route::get('/cart/data/store/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/product/mini/cart', [CartController::class, 'addMinCart']);
    Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'removeMiniCart']);
    Route::post('/dcart/data/store/{id}', [CartController::class, 'addToCartDetails']);
    Route::get('/checkout', [CheckoutController::class, 'checkoutCreate'])->name('checkout');
    Route::get('district-get/ajax/{division_id}', [CheckoutController::class, 'districtGetAjax']);
    Route::get('state-get/ajax/{district_id}', [CheckoutController::class, 'stateGetAjax']);
    Route::post('checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');

    /// Add to Wishlist
    Route::get('/add-to-wishlist/{product_id}', [WishlistController::class, 'addToWishList']);
    /// Add to Compare
    Route::post('add-to-compare/{product_id}', [CompareController::class, 'addToCompare']);



    // Site Blog Post All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('blog', 'blogs')->name('home.blog');
        Route::get('post/details/{id}/{slug}', 'blogDetails');
        Route::get('/post/details/{id}/{slug}', 'BlogDetails');
        Route::get('/post/category/{id}/{slug}', 'BlogPostCategory');
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('profile/update', [UserProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [UserProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('user.logout');



    // User Dashboard All Route
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('account/page', 'userAccount')->name('user.account.page');
        Route::get('order/page', 'orderPage')->name('user.order.page');
        Route::get('change/password', 'userChangePassword')->name('user.change.password');
        Route::get('order_details/{order_id}', 'userOrderDetails');
        Route::get('invoice_download/{order_id}', 'userOrderInvoice');
        Route::post('return/order/{order_id}', 'returnOrder')->name('return.order');
        Route::get('return/order/page', 'ReturnOrderPage')->name('return.order.page');
    });



    // Wishlists routes
    Route::get('/wishlist', [WishlistController::class, 'wishlists'])->name('wishlists');
    Route::get('get-wishlist-product', [WishlistController::class, 'getWishlistProduct']);
    Route::get('wishlist-remove/{id}', [WishlistController::class, 'wishlistRemove']);

    // Compare Routes
    Route::get('/compares', [CompareController::class, 'compares'])->name('compares');
    Route::get('get-compare-product', [CompareController::class, 'getCompareProduct']);
    Route::get('compare-remove/{id}',  [CompareController::class, 'compareRemove']);

    // Cart routes
    Route::get('/mycart', [CartController::class, 'mycart'])->name('mycart');
    Route::get('get-cart-product', [CartController::class, 'getCartProduct']);
    Route::get('cart-remove/{rowId}', [CartController::class, 'cartRemove']);
    Route::get('cart-decrement/{rowId}', [CartController::class, 'cartDecrement']);
    Route::get('cart-increment/{rowId}', [CartController::class, 'cartIncrement']);
    Route::post('coupon-apply', [CartController::class, 'couponApply']);
    Route::get('coupon-calculation', [CartController::class, 'couponCalculation']);
    Route::get('coupon-remove', [CartController::class, 'couponRemove']);

    // Payments routes
    Route::post('stripe/order', [StripeController::class, 'stripeOrder'])->name('stripe.order');
    Route::post('cash/order', [CashController::class, 'cashOrder'])->name('cash.order');
});
