<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

//HOME
Route::get('/',[HomeController::class,'index'])->name('home');




//users
Route::prefix('users')->group(function (){
    Route::get('/login', [UsersController::class, 'login'])->name('login');
    Route::post('/login', [UsersController::class, 'tryLogin'])->name('users.login');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/store', [UsersController::class, 'store'])->name('users.store');

    Route::get('/account', [UsersController::class, 'account'])->name('users.account');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

    Route::get('/address',[UsersController::class,'address'])->name('users.address');
    Route::post('/address', [UsersController::class, 'storeAddress'])->name('users.storeAddress');

    Route::get('/edit',[UsersController::class,'edit'])->name('users.edit');
    Route::post('/edit',[UsersController::class,'update'])->name('users.update');
});

//stores
Route::prefix('stores')->group(function (){
    Route::get('/create', [StoreController::class, 'create'])->name('stores.create')->middleware('auth');
    Route::post('/store', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/{store}',[StoreController::class,'show'])->name('stores.show');
    Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/{store}/update', [StoreController::class, 'update'])->name('stores.update');
    Route::get('/{store}/delete', [StoreController::class, 'destroy'])->name('stores.delete');

    Route::get('/{store}/products', [StoreController::class, 'products'])->name('stores.products');
});


//products
Route::prefix('products')->group(function (){
    Route::get('/create/{store}', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
    Route::post('{store}', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}',[ProductController::class,'show'])->name('products.show');
    Route::get('/{product}/edit',[ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');

});

//orders
Route::prefix('orders')->group(function(){
    Route::post('/addProducts/{product}',[OrderController::class,'addProduct'])->name('orders.addProduct');
});
