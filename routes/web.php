<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\TagController;
use App\Http\Controllers\Vendor\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::resource('superadmin/vendors', VendorController::class);
});

Route::middleware(['auth', 'role:vendor'])->name('vendor.')->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::resource('vendor/products', ProductController::class);
    Route::resource('vendor/tags', TagController::class);
    Route::resource('vendor/category', CategoryController::class);
});


// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
// });

// Route::group(['domain' => '{subdomain}.example.com'], function () {
//     Route::get('/', [VendorController::class, 'subdomainIndex']);
// });

require __DIR__.'/auth.php';
