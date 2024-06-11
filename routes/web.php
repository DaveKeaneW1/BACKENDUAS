<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerAuthenticationController;
use App\Http\Controllers\ProductController;


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


Route::get('/contact', [homeController::class, 'index'])->name('contact');
Route::get('/history', [homeController::class, 'index'])->name('history');
Route::get('/login', [CustomerAuthenticationController::class, 'login'])->name('authentication.login');
Route::post('/authenticate', [CustomerAuthenticationController::class, 'authenticate'])->name('authentication.authenticate');
Route::get('/registration', [CustomerAuthenticationController::class, 'registration'])->name('authentication.registration');
Route::post('/create_account', [CustomerAuthenticationController::class, 'create_account'])->name('authentication.create_account');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

Route::get('/admin/product', [AdminProductController::class, 'index'])->name('admin.product')->middleware('auth');;
Route::get('/admin/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
Route::get('/admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
Route::post('/admin/product/store', [AdminProductController::class, 'store'])->name('admin.product.store');
Route::put('/admin/product/update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
Route::delete('/admin/product/destroy/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::post('/product/get', [ProductController::class, 'add_to_cart_single'])->name('product.add_to_cart_single');
Route::post('/product/add_to_cart', [ProductController::class, 'add_to_cart'])->name('product.add_to_cart');
