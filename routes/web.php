<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\WishListComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminCouponComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/wishlist', WishListComponent::class)->name('product.wishlist');

Route::get('/thank-you', ThankYouComponent::class)->name('thankyou');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//For user
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');

    Route::get('user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.orders.details');

    Route::get('user/review/{order_item_id}', UserReviewComponent::class)->name('user.review');

    Route::get('user/change-password', UserChangePasswordComponent::class)->name('user.change-password');
});

//For admin
Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('admin/category', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('admin/category/add', AdminAddCategoryComponent::class)->name('admin.categories.add');
    Route::get('admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.categories.edit');

    Route::get('admin/product', AdminProductComponent::class)->name('admin.products');
    Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.products.add');
    Route::get('admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.products.edit');
    
    Route::get('admin/slider', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.homeslider.add');
    Route::get('admin/slider/edit/{slider_id}', AdminEditHomeSliderComponent::class)->name('admin.homeslider.edit');
    
    Route::get('admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homecategories');
    
    Route::get('admin/sale', AdminSaleComponent::class)->name('admin.sale');

    Route::get('admin/coupons', AdminCouponComponent::class)->name('admin.coupons');
    Route::get('admin/coupons/add', AdminAddCouponComponent::class)->name('admin.coupons.add');
    Route::get('admin/coupons/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.coupons.edit');

    Route::get('admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orders.details');
});