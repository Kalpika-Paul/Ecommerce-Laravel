<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class,'index']) ->name('welcome');

//Authentication
Route::get('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/login_post',[AuthController::class,'loginpost'])->name('auth.loginpost');
Route::get('/register',[AuthController::class,'register'])->name('auth.register');
Route::post('/register_post',[AuthController::class,'registerpost'])->name('auth.registerpost');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::get('/product/{slug}',[ProductController::class,'details'])->name('product.details');


Route::middleware('auth')->group(function () {
       Route::get('/cart/{id}', [ProductController::class, 'addToCart'])->name('product.addToCart');
       Route::get('/cart', [ProductController::class, 'showCart'])->name('product.showCart');
       Route::get('/checkout', [OrdersController::class, 'index'])->name('product.orders');
       Route::post('/checkout_data', [OrdersController::class, 'checkoutData'])->name('product.postmethod.orders');
       Route::get('/payment_succcess', [OrdersController::class, 'paymentSuccess'])->name('payment.success');
       Route::get('/payment_error', [OrdersController::class, 'paymentError'])->name('payment.error');
   });
   



