<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\user\ReviewController;
use App\Http\Controllers\user\StripeController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\user\AllUserController;
use App\Http\Controllers\user\CompareController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\FrontendVendor;
use App\Http\Controllers\frontend\homecontroller;
use App\Http\Controllers\user\WishlistController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\ReturnController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\backend\ActiveUserController;
use App\Http\Controllers\backend\SiteSettingController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\VendorOrderController;
use App\Http\Controllers\backend\ShippingAreaController;
use App\Http\Controllers\backend\VendorProductController;

// Frontent route
Route::controller(homecontroller::class)->group(function () {
    Route::get('/', 'index')->name('homePage');
    Route::get('/produt/details/{id}/{slug}', 'product_detailed');

    Route::get('/product/category/{id}', 'CatWiseProduct');
    Route::get('/product/sub-category/{id}/{slug}', 'SubCatWiseProduct');

    // Product View Modal With Ajax
    Route::get('/product/view/modal/{id}', 'ProductViewAjax');

});
Route::controller(CartController::class)->group(function () {
    /// Add to cart store data
    Route::post('/cart/data/store/{id}', 'AddToCart');

    // Get Data from mini Cart
    Route::get('/product/mini/cart', 'AddMiniCart');

    Route::get('/minicart/product/remove/{rowId}', 'RemoveMiniCart');

    /// Add to cart store data For Product Details Page
    Route::post('/dcart/data/store/{id}', 'AddToCartDetails');

});

//   Add to wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
/// Add to Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

Route::controller(FrontendVendor::class)->group(function () {

    Route::get('/vendor-list', 'vendorList')->name('vendor_list');
    Route::get('/vendor/details/{id}', 'vendor_detailed');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');

    /// Frontend Coupon Option
    Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
});

// Frontend Blog Post All Route
Route::controller(BlogController::class)->group(function () {

    Route::get('/blog', 'AllBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');
    Route::get('/post/category/{id}/{slug}', 'BlogPostCategory');

});

// ====== user
// Route::get('/login', [UserController::class, 'userLogin'])->name('login');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        route::get('/logout', 'userLogout')->name('user.logout');

        // profile
        route::post('/profile/update', 'profileUpdate')->name('profile.update');
        route::post('/user/password/update', 'passwordUpdate')->name('user.password.update');

    });

    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });

    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product', 'GetCompareProduct');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });

    Route::controller(CartController::class)->group(function () {

        // Checkout Page Route
        Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/district-get/ajax/{division_id}', 'DistrictGetAjax');
        Route::get('/state-get/ajax/{district_id}', 'StateGetAjax');

        Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
    });

    Route::controller(StripeController::class)->group(function () {
        Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
        Route::post('/cash/order', 'CashOrder')->name('cash.order');

    });

    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');

        Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');

        Route::get('/user/order_details/{order_id}', 'UserOrderDetails');
        Route::get('/user/invoice_download/{order_id}', 'UserOrderInvoice');

        Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order');

        Route::get('/return/order/page', 'ReturnOrderPage')->name('return.order.page');

        // Order Tracking
        Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');
        Route::post('/order/tracking', 'OrderTracking')->name('order.tracking');

    });

    // Frontend Blog Post All Route
    Route::controller(ReviewController::class)->group(function () {

        Route::post('/store/review', 'StoreReview')->name('store.review');

    });
});

// ========= admin
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        route::get('/admin/logout', 'adminLogout')->name('admin.logout');

        // profile
        route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        route::post('/admin/profile/update', 'adminProfileUpdate')->name('admin.profile.update');

        // password
        route::get('/admin/password', 'adminPassword')->name('admin.password');
        route::post('/admin/password/update', 'adminPasswordUpdate')->name('admin.password.update');

        // vendor management
        Route::get('inactive/vendor', 'inactiveVendor')->name('inactive.vendor');
        Route::get('inactive/vendor/details/{id}', 'inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('active/inactive/vendor', 'activeInactiveVendor')->name('active.inactive.vendor');

        Route::get('active/vendor', 'activeVendor')->name('active.vendor');
        Route::get('active/vendor/details/{id}', 'activeVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/active/vendor', 'inactiveActiveVendor')->name('inactive.active.vendor');
    });
    // brand
    Route::controller(BrandController::class)->group(function () {
        Route::get('all/brand', 'allBrand')->name('all.brand');
        Route::get('create/brand', 'createBrand')->name('create.brand');
        Route::post('store/brand', 'storeBrand')->name('store.brand');
        Route::get('edit/brand/{id}', 'editBrand')->name('edit.brand');
        Route::post('update/brand', 'updateBrand')->name('update.brand');
        Route::get('delete/brand/{id}', 'deleteBrand')->name('delete.brand');
    });
    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all/category', 'index')->name('all.category');
        Route::get('create/category', 'create')->name('create.category');
        Route::post('store/category', 'store')->name('store.category');
        Route::get('edit/category/{id}', 'edit')->name('edit.category');
        Route::post('update/category', 'update')->name('update.category');
        Route::get('delete/category/{id}', 'delete')->name('delete.category');
    });
    // sub Category
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('all/subcategory', 'index')->name('all.subcategory');
        Route::get('create/subcategory', 'create')->name('create.subcategory');
        Route::post('store/subcategory', 'store')->name('store.subcategory');
        Route::get('edit/subcategory/{id}', 'edit')->name('edit.subcategory');
        Route::post('update/subcategory', 'update')->name('update.subcategory');
        Route::get('delete/subcategory/{id}', 'delete')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });

    // Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('all/product', 'index')->name('all.product');
        Route::get('create/product', 'create')->name('create.product');
        Route::post('store/product', 'store')->name('store.product');
        Route::get('edit/product/{id}', 'edit')->name('edit.product');
        Route::post('update/product', 'update')->name('update.product');
        Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');

        Route::post('/update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MulitImageDelelte')->name('product.multiimg.delete');
        Route::get('/product/inactive/{id}', 'productInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'productActive')->name('product.active');

    });

    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');

    });

    // Banner All Route
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    // coupon controller
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    Route::controller(ShippingAreaController::class)->group(function () {
        // division
        Route::get('/all/division', 'AllDivision')->name('all.division');
        Route::get('/add/division', 'AddDivision')->name('add.division');
        Route::post('/store/division', 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}', 'EditDivision')->name('edit.division');
        Route::post('/update/division', 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}', 'DeleteDivision')->name('delete.division');

        // districts
        Route::get('/all/district', 'AllDistrict')->name('all.district');
        Route::get('/add/district', 'AddDistrict')->name('add.district');
        Route::post('/store/district', 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}', 'EditDistrict')->name('edit.district');
        Route::post('/update/district', 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');

        // state
        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');

        Route::get('/district/ajax/{division_id}', 'GetDistrict');
    });

    // Admin Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');

        Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');

        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');

        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');

        Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}', 'ConfirmToProcess')->name('confirm-processing');

        Route::get('/processing/delivered/{order_id}', 'ProcessToDelivered')->name('processing-delivered');

        Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');

    });
    // Return Order All Route
    Route::controller(ReturnController::class)->group(function () {
        Route::get('/return/request', 'ReturnRequest')->name('return.request');

        Route::get('/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('return.request.approved');

        Route::get('/complete/return/request', 'CompleteReturnRequest')->name('complete.return.request');

    });
    // Report All Route
    Route::controller(ReportController::class)->group(function () {

        Route::get('/report/view', 'ReportView')->name('report.view');
        Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
        Route::post('/search/by/month', 'SearchByMonth')->name('search-by-month');
        Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');

        Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
        Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');

    });
    // Active user and vendor All Route
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all-user');
        Route::get('/all/vendor', 'AllVendor')->name('all-vendor');
    });

    // Blog Category All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('/admin/blog/category', 'AllBlogCateogry')->name('admin.blog.category');

        Route::get('/admin/add/blog/category', 'AddBlogCateogry')->name('add.blog.categroy');

        Route::post('/admin/store/blog/category', 'StoreBlogCateogry')->name('store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'EditBlogCateogry')->name('edit.blog.category');

        Route::post('/admin/update/blog/category', 'UpdateBlogCateogry')->name('update.blog.category');

        Route::get('/admin/delete/blog/category/{id}', 'DeleteBlogCateogry')->name('delete.blog.category');

    });

    // Blog Post All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('/admin/blog/post', 'AllBlogPost')->name('admin.blog.post');

        Route::get('/admin/add/blog/post', 'AddBlogPost')->name('add.blog.post');

        Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');

        Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');

        Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');

    });

    // Admin Reviw All Route
    Route::controller(ReviewController::class)->group(function () {

        Route::get('/pending/review', 'PendingReview')->name('pending.review');
        Route::get('/review/approve/{id}', 'ReviewApprove')->name('review.approve');
        Route::get('/publish/review', 'PublishReview')->name('publish.review');
        Route::get('/review/delete/{id}', 'ReviewDelete')->name('review.delete');
    });

    // Site Setting All Route
    Route::controller(SiteSettingController::class)->group(function () {

        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/setting/update', 'SiteSettingUpdate')->name('site.setting.update');

        Route::get('/seo/setting', 'SeoSetting')->name('seo.setting');
        Route::post('/seo/setting/update', 'SeoSettingUpdate')->name('seo.setting.update');
    });


});

// ======vendor
Route::get('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'become_vendor'])->name('become_vendor');
Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendorRegister');

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::controller(VendorController::class)->group(function () {
        Route::get('/vendor/dashboard', 'dashboard')->name('vendor.dashobard');
        route::get('/vendor/logout', 'vendorLogout')->name('vendor.logout');

        // profile
        route::get('/vendor/profile', 'vendorProfile')->name('vendor.profile');
        route::post('/vendor/profile/update', 'vendorProfileUpdate')->name('vendor.profile.update');
        // password
        route::get('/vendor/password', 'vendorPassword')->name('vendor.password');
        route::post('/vendor/password/update', 'vendorPasswordUpdate')->name('vendor.password.update');
    });

    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/create/product', 'VendorCreateProduct')->name('vendor.create.product');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::get('/vendor/product/delete/{id}', 'ProductDelete')->name('vendor.product.delete');

        Route::post('/vendor/update/product/thambnail', 'UpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/vendor/update/product/multiimage', 'UpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/product/multiimg/delete/{id}', 'MulitImageDelelte')->name('vendor.product.multiimg.delete');

        Route::get('/vendor/product/inactive/{id}', 'productInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'productActive')->name('vendor.product.active');

        Route::get('/subcategory/vendor/ajax/{category_id}', 'GetVendorSubCategory');

    });
    // Brand All Route
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/order', 'VendorOrder')->name('vendor.order');
        Route::get('/vendor/return/order', 'VendorReturnOrder')->name('vendor.return.order');

        Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
        Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');

    });

    Route::controller(ReviewController::class)->group(function () {

        Route::get('/vendor/all/review', 'VendorAllReview')->name('vendor.all.review');

    });
});

require __DIR__ . '/auth.php';
