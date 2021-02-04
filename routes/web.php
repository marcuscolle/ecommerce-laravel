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

// Mens Page Route
Route::get('products/men', [App\Http\Controllers\ProductController::class, 'menProducts'])->name('menProducts');

// women Page Route
Route::get('products/women', [App\Http\Controllers\ProductController::class, 'womenProducts'])->name('womenProducts');







//route to add product to the cart by id
Route::get('product/addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addProductToCart'])->name('AddToCartProduct');

// Cart items
Route::get('cart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cartproducts');

// delete item from cart
Route::get('product/deleteItemFromCart/{id}', [App\Http\Controllers\ProductController::class, 'deleteItemFromCart'])->name('deleteItemFromCart');







// Admin Panel  --> middleware to admin access the admin panel
Route::get('admin/products', [App\Http\Controllers\AdminProductsController::class, 'index'])->name('adminDisplayProducts')->middleware('restrictToAdmin');

// Display Edit Product From
Route::get('admin/editProductForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductForm'])->name('adminEditProductForm')->middleware('restrictToAdmin');;

// Display Product Image Form
Route::get('admin/editProductImageForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductImageForm'])->name('adminEditProductImageForm')->middleware('restrictToAdmin');;

// Update Product Image
Route::post('admin/updateProductImage/{id}', [App\Http\Controllers\AdminProductsController::class, 'updateProductImage'])->name('adminUpdateProductImage')->middleware('restrictToAdmin');;

// Update Product Details
Route::post('admin/updateProduct/{id}', [App\Http\Controllers\AdminProductsController::class, 'updateProduct'])->name('adminUpdateProduct')->middleware('restrictToAdmin');;







// Display Create Product From
Route::get('admin/createProductForm', [App\Http\Controllers\AdminProductsController::class, 'createProductForm'])->name('adminCreateProductForm')->middleware('restrictToAdmin');;

// Create New Product
Route::post('admin/newProductForm', [App\Http\Controllers\AdminProductsController::class, 'newProductForm'])->name('adminNewProductForm')->middleware('restrictToAdmin');;

// Delete Product
Route::get('admin/deleteProduct/{id}', [App\Http\Controllers\AdminProductsController::class, 'deleteProduct'])->name('adminDeleteProduct')->middleware('restrictToAdmin');;



