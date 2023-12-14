<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\VendorProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\FrontendVendor;
use App\Http\Controllers\frontend\homecontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\user\CompareController;
use App\Http\Controllers\user\WishlistController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

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
        Route::get('/get-compare-product' , 'GetCompareProduct');
        Route::get('/compare-remove/{id}' , 'CompareRemove');
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
});

require __DIR__ . '/auth.php';
