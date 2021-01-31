<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;

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

// authentication
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Products route
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');

//route to add product to the cart by id
Route::get('product/addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addProductToCart'])->name('AddToCartProduct');

// Cart items
Route::get('cart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cartproducts');

// delete item from cart
Route::get('product/deleteItemFromCart/{id}', [App\Http\Controllers\ProductController::class, 'deleteItemFromCart'])->name('deleteItemFromCart');

// Admin Panel
// Route::get('admin/products', [App\Http\Controllers\AdminProductsContoller::class, 'index'])->name('adminDisplayProducts');
Route::get('admin/products', [App\Http\Controllers\AdminProductsController::class, 'index'])->name('adminDisplayProducts');

// Display Edit Product From
Route::get('admin/editProductForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductForm'])->name('adminEditProductForm');

// Display Product Image Form
Route::get('admin/editProductImageForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductImageForm'])->name('adminEditProductImageForm');

// Update Product Image
Route::post('admin/updateProductImage/{id}', [App\Http\Controllers\AdminProductsController::class, 'updateProductImage'])->name('adminUpdateProductImage');