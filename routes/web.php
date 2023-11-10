<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    });
});
// vendor
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
