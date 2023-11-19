<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('frontend.index');
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
});

// ========= admin
Route::get('/admin/login', [AdminController::class, 'adminLogin']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'dashboard');
        route::get('/admin/logout', 'adminLogout')->name('admin.logout');

        // profile
        route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        route::post('/admin/profile/update', 'adminProfileUpdate')->name('admin.profile.update');
        // password
        route::get('/admin/password', 'adminPassword')->name('admin.password');
        route::post('/admin/password/update', 'adminPasswordUpdate')->name('admin.password.update');

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
       });
    });
});

// ======vendor
Route::get('/vendor/login', [VendorController::class, 'vendorLogin']);
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::controller(VendorController::class)->group(function () {
        Route::get('/vendor/dashboard', 'dashboard');
        route::get('/vendor/logout', 'vendorLogout')->name('vendor.logout');

        // profile
        route::get('/vendor/profile', 'vendorProfile')->name('vendor.profile');
        route::post('/vendor/profile/update', 'vendorProfileUpdate')->name('vendor.profile.update');
        // password
        route::get('/vendor/password', 'vendorPassword')->name('vendor.password');
        route::post('/vendor/password/update', 'vendorPasswordUpdate')->name('vendor.password.update');
    });
});

require __DIR__ . '/auth.php';
