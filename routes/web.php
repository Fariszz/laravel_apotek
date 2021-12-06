<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class, 'index']);
Route::get('/',[HomeController::class, 'search'])->name('search');

Route::get('/product/{id}',[HomeController::class, 'show'])->name('produk.show');
Route::post('/product/{id}', [OrderController::class, 'order'])->name('produk.order');

Auth::routes();

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard.index')->middleware('adminKaryawan');

Route::prefix('dashboard')->group(function(){
    Route::resource('product', ProductController::class)->middleware('adminKaryawan');
    Route::resource('users', UserController::class)->middleware('IsAdmin');
});

//* Cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
