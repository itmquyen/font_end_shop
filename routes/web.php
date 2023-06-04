<?php

use Illuminate\Support\Facades\Route;

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

Route::get('wishlist/', function () {
    return view('wishlist');
});

Route::get('product/', function () {
    return view('products.detail_row');
});

Route::get('product/detail/', function () {
    return view('products.detail');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('menus',[App\Http\Controllers\MenuController::class, 'index']);
Route::get('menus-show',[App\Http\Controllers\MenuController::class, 'show']);
Route::post('menus',[App\Http\Controllers\MenuController::class, 'store'])->name('menus.store');
