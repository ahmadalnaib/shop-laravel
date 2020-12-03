<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\StoreController;
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
    return view('home');
});


//users
Route::prefix('users')->group(function (){
    Route::get('/login', [UsersController::class, 'login'])->name('login');
    Route::post('/login', [UsersController::class, 'tryLogin'])->name('users.login');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/store', [UsersController::class, 'store'])->name('users.store');

    Route::get('/account', [UsersController::class, 'account'])->name('users.account');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
});

//stores
Route::prefix('stores')->group(function (){
    Route::get('/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/store', [StoreController::class, 'store'])->name('stores.store');



});
