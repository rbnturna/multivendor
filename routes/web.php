<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\TagController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\ProductVariationController;
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

    Route::get('vendor/product/variations/create/{id}', [ProductVariationController::class, 'createByProduct'])->name('product.variations.create');
    Route::post('vendor/product/variations/{id}', [ProductVariationController::class, 'storeByProduct'])->name('product.variations.store');
    Route::get('vendor/product/variations/edit/{id}/{variationId}', [ProductVariationController::class, 'editByProduct'])->name('product.variations.edit');
    Route::post('vendor/product/variations/update/{id}/{variationId}', [ProductVariationController::class, 'updateByProduct'])->name('product.variations.update');
    Route::delete('vendor/product/variations/{variationId}', [ProductVariationController::class, 'destroy'])->name('product.variations.destroy');

    Route::get('vendor/variations', [ProductVariationController::class, 'index'])->name('variations.index');
    Route::get('vendor/variations/create', [ProductVariationController::class, 'create'])->name('variations.create');
    Route::post('vendor/variations', [ProductVariationController::class, 'store'])->name('variations.store');
    
    // Attribute Management
    Route::get('vendor/attributes', [ProductVariationController::class, 'manageAttributes'])->name('attributes.index');
    Route::get('vendor/attributes/create', [ProductVariationController::class, 'createAttribute'])->name('attributes.create');
    Route::post('vendor/attributes', [ProductVariationController::class, 'storeAttribute'])->name('attributes.store');
    Route::get('vendor/attributes/{attribute}/edit', [ProductVariationController::class, 'editAttribute'])->name('attributes.edit');
    Route::put('vendor/attributes/{attribute}', [ProductVariationController::class, 'updateAttribute'])->name('attributes.update');
    Route::delete('vendor/attributes/{attribute}', [ProductVariationController::class, 'destroyAttribute'])->name('attributes.destroy');

});


// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
// });

// Route::group(['domain' => '{subdomain}.example.com'], function () {
//     Route::get('/', [VendorController::class, 'subdomainIndex']);
// });

require __DIR__.'/auth.php';
