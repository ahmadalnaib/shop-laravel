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

Route::group(['middleware'=>['auth']],function (){
    Route::get('/account', [UsersController::class, 'account'])->name('users.account');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/address',[UsersController::class,'address'])->name('users.address');
    Route::post('/address', [UsersController::class, 'storeAddress'])->name('users.storeAddress');
    Route::get('/edit',[UsersController::class,'edit'])->name('users.edit');
    Route::post('/edit',[UsersController::class,'update'])->name('users.update');
});
});

//stores
Route::prefix('stores')->group(function (){

    Route::group(['middleware'=>['auth']],function (){
    Route::get('/orders',[StoreController::class,'orders'])->name('stores.orders');
    Route::get('/create', [StoreController::class, 'create'])->name('stores.create')->middleware('auth');
    Route::post('/store', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/{store}/update', [StoreController::class, 'update'])->name('stores.update');
    Route::get('/{store}/delete', [StoreController::class, 'destroy'])->name('stores.delete');
        Route::get('/{store}/products', [StoreController::class, 'products'])->name('stores.products');
    });
    Route::get('/{store}',[StoreController::class,'show'])->name('stores.show');

});


//products
Route::prefix('products')->group(function (){

    Route::group(['middleware'=>['auth']],function (){
    Route::get('/create/{store}', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
    Route::post('{store}', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/edit',[ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');

});
    Route::get('/{product}',[ProductController::class,'show'])->name('products.show');
});


//orders
Route::group(['prefix'=>'orders','middleware'=>'auth'],function (){

    Route::get('/',[OrderController::class,'index'])->name('orders.index');
    Route::get('/{order}/delivered',[OrderController::class,'delivered'])->name('orders.delivered');
    Route::get('/create',[OrderController::class,'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/addProducts/{product}',[OrderController::class,'addProduct'])->name('orders.addProduct');
    Route::get('/chargeRequest',[OrderController::class,'chargeRequest'])->name('orders.chargeRequest');
    Route::get('/chargeUpdate',[OrderController::class,'chargeUpdate'])->name('orders.chargeUpdate');
    Route::get('/{order}',[OrderController::class,'show'])->name('orders.show');
});


