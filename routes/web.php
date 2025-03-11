<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Vendor\AffiliateHomeController;
use App\Http\Controllers\Vendor\AffiliateOrderController;
use App\Http\Controllers\Vendor\VendorHomeController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PageController;


use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\TagController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\ProductVariationController;
use App\Http\Controllers\Vendor\BlogController as VendorBlogController;
use App\Http\Controllers\Vendor\BlogCategoryController;
use App\Http\Controllers\Vendor\BlogTagController;


use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;


// use App\Http\Controllers\SuperAdmin\SuperAdminController;

use App\Http\Controllers\SuperAdmin\VendorController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\AffiliateHomeController as SAffiliateHomeController;
use App\Http\Controllers\SuperAdmin\OrderController as SOrderController;
use App\Http\Controllers\SuperAdmin\PageController as SPageController;
use App\Http\Controllers\SuperAdmin\ProductController as SProductController;
use App\Http\Controllers\SuperAdmin\TagController as STagController;
use App\Http\Controllers\SuperAdmin\CategoryController as SCategoryController;
use App\Http\Controllers\SuperAdmin\ProductVariationController as SProductVariationController;
use App\Http\Controllers\SuperAdmin\BlogController as SBlogController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:superadmin'])->name('superadmin.')->group(function () {
    // Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::resource('superadmin/vendors', VendorController::class);
    Route::get('/superadmin/affiliate/dashboard', [SAffiliateHomeController::class, 'index'])->name('affiliate.dashboard');

    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('vendor.dashboard');
    Route::resource('superadmin/products', SProductController::class);
    Route::resource('superadmin/tags', STagController::class);
    Route::resource('superadmin/category', SCategoryController::class);
    Route::resource('superadmin/blogs', SBlogController::class);
    
    Route::get('superadmin/orders/canceled', [SOrderController::class, 'canceledOrders'])->name('orders.canceled');
    Route::get('superadmin/orders/completed', [SOrderController::class, 'completedOrders'])->name('orders.completed');
    Route::resource('superadmin/orders', SOrderController::class);
    
    Route::get('superadmin/api/products/{id}/variations', [SProductController::class, 'getVariations'])->name('api.products.variations');

    Route::get('superadmin/products/variations/create/{id}', [SProductVariationController::class, 'createByProduct'])->name('products.variations.create');
    Route::post('superadmin/products/variations/{id}', [SProductVariationController::class, 'storeByProduct'])->name('products.variations.store');
    Route::get('superadmin/products/variations/edit/{id}/{variationId}', [SProductVariationController::class, 'editByProduct'])->name('products.variations.edit');
    Route::post('superadmin/products/variations/update/{id}/{variationId}', [SProductVariationController::class, 'updateByProduct'])->name('products.variations.update');
    Route::delete('superadmin/products/variations/{variationId}', [SProductVariationController::class, 'destroy'])->name('products.variations.destroy');

    Route::get('superadmin/variations', [SProductVariationController::class, 'index'])->name('variations.index');
    Route::get('superadmin/variations/create', [SProductVariationController::class, 'create'])->name('variations.create');
    Route::post('superadmin/variations', [SProductVariationController::class, 'store'])->name('variations.store');
    
    // Attribute Management
    Route::get('superadmin/attributes', [SProductVariationController::class, 'manageAttributes'])->name('attributes.index');
    Route::get('superadmin/attributes/create', [SProductVariationController::class, 'createAttribute'])->name('attributes.create');
    Route::post('superadmin/attributes', [SProductVariationController::class, 'storeAttribute'])->name('attributes.store');
    Route::get('superadmin/attributes/{attribute}/edit', [SProductVariationController::class, 'editAttribute'])->name('attributes.edit');
    Route::put('superadmin/attributes/{attribute}', [SProductVariationController::class, 'updateAttribute'])->name('attributes.update');
    Route::delete('superadmin/attributes/{attribute}', [SProductVariationController::class, 'destroyAttribute'])->name('attributes.destroy');


    Route::resource('superadmin/pages', SPageController::class);
    Route::get('superadmin/pages/{page}', [SPageController::class, 'show'])->name('pages.show');
    Route::post('superadmin/contact-submit', [SPageController::class, 'handleContactForm'])->name('contact.submit');
    Route::post('superadmin/newsletter-submit', [SPageController::class, 'handleNewsletterForm'])->name('newsletter.submit');

});
// Route::get('/vendor', function () {
//     return view('vendor.home'); 
// })->middleware(['auth', 'role:vendor'])->name('vendor.home');

Route::get('/', [FrontendController::class, 'home'])->name('home');
// Route::get('/product/{slug}', [FrontendController::class, 'index'])->name('home');
Route::get('/product', [FrontendController::class, 'product'])->name('shop');
Route::get('/product/{slug}', [FrontendController::class, 'detail'])->name('product.detail'); // Fix here
Route::get('/detail', [FrontendController::class, 'detail'])->name('detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
// Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');

// Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::put('/cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/order-success/{order}', [CartController::class, 'showOrderSuccess'])->name('order.success');


Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::middleware(['auth', 'role:vendor'])->name('vendor.')->group(function () {
    Route::get('/vendor/affiliate/dashboard', [AffiliateHomeController::class, 'index'])->name('affiliate.dashboard');
    
    Route::get('vendor/affiliate/orders/canceled', [AffiliateOrderController::class, 'canceledOrders'])->name('affiliate.orders.canceled');
    Route::get('vendor/affiliate/orders/completed', [AffiliateOrderController::class, 'completedOrders'])->name('affiliate.orders.completed');
    Route::name('affiliate.')->group(function () {
    Route::resource('vendor/affiliate/orders', AffiliateOrderController::class);
    });


    Route::get('/vendor/dashboard', [VendorHomeController::class, 'index'])->name('vendor.dashboard');
    Route::resource('vendor/products', ProductController::class);
    Route::resource('vendor/tags', TagController::class);
    Route::resource('vendor/category', CategoryController::class);
    Route::resource('vendor/blogs', VendorBlogController::class);
    Route::post('vendor/blog/upload', [VendorBlogController::class, 'upload'])->name('blog.upload');
    Route::resource('vendor/blogcategories', BlogCategoryController::class);
    Route::resource('vendor/blogtag', BlogTagController::class);
    
    Route::get('vendor/orders/canceled', [OrderController::class, 'canceledOrders'])->name('orders.canceled');
    Route::get('vendor/orders/completed', [OrderController::class, 'completedOrders'])->name('orders.completed');
    Route::resource('vendor/orders', OrderController::class);


    
    Route::get('vendor/api/products/{id}/variations', [ProductController::class, 'getVariations'])->name('api.products.variations');

    Route::get('vendor/products/variations/create/{id}', [ProductVariationController::class, 'createByProduct'])->name('products.variations.create');
    Route::post('vendor/products/variations/{id}', [ProductVariationController::class, 'storeByProduct'])->name('products.variations.store');
    Route::get('vendor/products/variations/edit/{id}/{variationId}', [ProductVariationController::class, 'editByProduct'])->name('products.variations.edit');
    Route::post('vendor/products/variations/update/{id}/{variationId}', [ProductVariationController::class, 'updateByProduct'])->name('products.variations.update');
    Route::delete('vendor/products/variations/{variationId}', [ProductVariationController::class, 'destroy'])->name('products.variations.destroy');

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


    Route::resource('vendor/pages', PageController::class);
    Route::get('vendor/pages/{page}', [PageController::class, 'show'])->name('pages.show');
    Route::post('vendor/contact-submit', [PageController::class, 'handleContactForm'])->name('contact.submit');
    Route::post('vendor/newsletter-submit', [PageController::class, 'handleNewsletterForm'])->name('newsletter.submit');

});


// Route::middleware(['auth', 'role:superadmin'])->group(function () {
//     // Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
// });

// Route::group(['domain' => '{subdomain}.example.com'], function () {
//     Route::get('/', [VendorController::class, 'subdomainIndex']);
// });

require __DIR__.'/auth.php';
