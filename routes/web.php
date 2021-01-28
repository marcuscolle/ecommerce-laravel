<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');

//route to add product to the cart by id
Route::get('product/addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addProductToCart'])->name('AddToCartProduct');

// Cart items
Route::get('cart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cartproducts');

// delete item from cart
Route::get('product/deleteItemFromCart/{id}', [App\Http\Controllers\ProductController::class, 'deleteItemFromCart'])->name('deleteItemFromCart');