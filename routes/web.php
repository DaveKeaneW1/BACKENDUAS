<?php

use App\Http\Controllers\AdminAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerAuthenticationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [homeController::class, 'index'])->name('home');


Route::get('/contact', [homeController::class, 'contact'])->name('contact');

Route::get('/login', [CustomerAuthenticationController::class, 'login'])->name('authentication.login');
Route::post('/authenticate', [CustomerAuthenticationController::class, 'authenticate'])->name('authentication.authenticate');
Route::get('/registration', [CustomerAuthenticationController::class, 'registration'])->name('authentication.registration');
Route::post('/create_account', [CustomerAuthenticationController::class, 'create_account'])->name('authentication.create_account');



Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/add_to_cart_single/{id}', [ProductController::class, 'add_to_cart_single'])->name('product.add_to_cart_single');
Route::post('/product/add_to_cart', [ProductController::class, 'add_to_cart'])->name('product.add_to_cart');


Route::get('/logout', [CustomerAuthenticationController::class, 'logout'])->name('authentication.logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart');  
Route::get('/cart/remove_order_item/{id}', [CartController::class, 'remove_item_from_cart'])->name('cart.remove_item');  
Route::post('/cart/update-quantity', [CartController::class, 'update_order_item_qty'])->name('cart.update_quantity');
Route::post('/cart/shipping', [CartController::class, 'update_shipping'])->name('cart.shipping');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout_process', [CartController::class, 'checkout_process'])->name('cart.checkout_process');

Route::get('/confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');


Route::get('/history', [OrderController::class, 'index'])->name('history');
Route::get('/orders/detail/{id}', [OrderController::class, 'detail'])->name('orders.detail');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');


Route::middleware(['auth'])->group(function () {
  Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

  Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
  Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
  Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
  Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
  Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
  Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

  Route::get('/admin/product', [AdminProductController::class, 'index'])->name('admin.product');
  Route::get('/admin/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
  Route::get('/admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
  Route::post('/admin/product/store', [AdminProductController::class, 'store'])->name('admin.product.store');
  Route::put('/admin/product/update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
  Route::delete('/admin/product/destroy/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

  Route::get('/admin/admin', [AdminAdminController::class, 'index'])->name('admin.admin');
  Route::get('/admin/admin/create', [AdminAdminController::class, 'create'])->name('admin.admin.create');
  Route::get('/admin/admin/edit/{id}', [AdminAdminController::class, 'edit'])->name('admin.admin.edit');
  Route::post('/admin/admin/store', [AdminAdminController::class, 'store'])->name('admin.admin.store');
  Route::put('/admin/admin/update/{id}', [AdminAdminController::class, 'update'])->name('admin.admin.update');
  Route::delete('/admin/admin/destroy/{id}', [AdminAdminController::class, 'destroy'])->name('admin.admin.destroy');

  Route::get('/admin/customer', [AdminCustomerController::class, 'index'])->name('admin.customer');
  Route::get('/admin/customer/create', [AdminCustomerController::class, 'create'])->name('admin.customer.create');
  Route::get('/admin/customer/edit/{id}', [AdminCustomerController::class, 'edit'])->name('admin.customer.edit');
  Route::post('/admin/customer/store', [AdminCustomerController::class, 'store'])->name('admin.customer.store');
  Route::put('/admin/customer/update/{id}', [AdminCustomerController::class, 'update'])->name('admin.customer.update');
  Route::delete('/admin/customer/destroy/{id}', [AdminCustomerController::class, 'destroy'])->name('admin.customer.destroy');


  Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
  Route::get('/admin/orders/detail/{id}', [AdminOrderController::class, 'detail'])->name('admin.orders.detail');
  Route::get('/admin/orders/ubah_status/{id}', [AdminOrderController::class, 'ubah_status'])->name('admin.orders.ubah_status');
  Route::put('/admin/orders/ubah_status/{id}', [AdminOrderController::class, 'ubah_status_process'])->name('admin.orders.ubah_status_process');

});
