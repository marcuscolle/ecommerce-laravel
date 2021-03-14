<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\http\Controllers\PaymentsController;
use App\http\Controllers\EmailController;

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

// authentication
Auth::routes();

//Login Panel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');



// Products route
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products');






// Mens Page Route
Route::get('products/men', [App\Http\Controllers\ProductController::class, 'menProducts'])->name('menProducts');

// Mens Shoes Page Route
Route::get('products/men/shoes', [App\Http\Controllers\ProductController::class, 'menShoes'])->name('menShoes');

// Mens Pants Page Route
Route::get('products/men/pants', [App\Http\Controllers\ProductController::class, 'menPants'])->name('menPants');

// Mens Shirts Page Route
Route::get('products/men/shirts', [App\Http\Controllers\ProductController::class, 'menShirts'])->name('menShirts');

// Mens Shorts Page Route
Route::get('products/men/shorts', [App\Http\Controllers\ProductController::class, 'menShorts'])->name('menShorts');







// women Page Route
Route::get('products/women', [App\Http\Controllers\ProductController::class, 'womenProducts'])->name('womenProducts');

// women dress Route
Route::get('products/women/dress', [App\Http\Controllers\ProductController::class, 'womenDress'])->name('womenDress');

// women Pants Route
Route::get('products/women/pants', [App\Http\Controllers\ProductController::class, 'womenPants'])->name('womenPants');

// women Shits Route
Route::get('products/women/shirts', [App\Http\Controllers\ProductController::class, 'womenShirts'])->name('womenShirts');

// women ShoesRoute
Route::get('products/women/shoes', [App\Http\Controllers\ProductController::class, 'womenShoes'])->name('womenShoes');




// shoes Page Route
Route::get('products/shoes', [App\Http\Controllers\ProductController::class, 'shoes'])->name('shoes');




// kids Page Route
Route::get('products/kids', [App\Http\Controllers\ProductController::class, 'kids'])->name('kids');

// kids Shoes Route
Route::get('products/kids/shoes', [App\Http\Controllers\ProductController::class, 'kidsShoes'])->name('kidsShoes');




// Accessories Page Route
Route::get('products/accessories', [App\Http\Controllers\ProductController::class, 'accessories'])->name('accessories');




//Search Box Route
Route::get('search', [App\Http\Controllers\ProductController::class, 'search'])->name('searchProducts');








//route to add product to the cart by id
Route::get('product/addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addProductToCart'])->name('AddToCartProduct');

// Cart items
Route::get('cart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cartproducts');

// delete item from cart
Route::get('product/deleteItemFromCart/{id}', [App\Http\Controllers\ProductController::class, 'deleteItemFromCart'])->name('deleteItemFromCart');

// Cart Increase Quantity
Route::get('product/increaseProduct/{id}', [App\Http\Controllers\ProductController::class, 'increaseProduct'])->name('IncreaseProduct');

// Cart Decrease Quantity
Route::get('product/decreaseProduct/{id}', [App\Http\Controllers\ProductController::class, 'decreaseProduct'])->name('DecreaseProduct');

//Checkout w/details customer details form
Route::get('product/checkoutproducts/', [App\Http\Controllers\ProductController::class, 'checkoutproducts'])->name('checkoutproducts');







//Create New Order
Route::get('payment/createNewOrder/', [App\Http\Controllers\PaymentsController::class, 'createNewOrder'])->name('createNewOrder');

//Payment Page
Route::get('payment/paymentpage/', [App\Http\Controllers\PaymentsController::class, 'paymentpage'])->name('paymentpage');

//Payment Receipt
Route::get('payment/paymentreceipt/{paymenyID}/{payerID}', [App\Http\Controllers\PaymentsController::class, 'paymentreceipt'])->name('paymentreceipt');








// Admin Panel  --> middleware to admin access the admin panel
Route::get('admin/products', [App\Http\Controllers\AdminProductsController::class, 'index'])->name('adminDisplayProducts')->middleware('restrictToAdmin');

// Admin Dashboard home
Route::get('admin/dashboard', [App\Http\Controllers\AdminProductsController::class, 'dashboard'])->name('dashboard')->middleware('restrictToAdmin');

// Admin Display Orders
Route::get('admin/orders', [App\Http\Controllers\AdminProductsController::class, 'orders'])->name('orders')->middleware('restrictToAdmin');

// Admin Display Customers
Route::get('admin/customers', [App\Http\Controllers\AdminProductsController::class, 'customers'])->name('customers')->middleware('restrictToAdmin');

// Admin Display Earnings
Route::get('admin/earnings', [App\Http\Controllers\AdminProductsController::class, 'earnings'])->name('earnings')->middleware('restrictToAdmin');








// Display Edit Product From
Route::get('admin/editProductForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductForm'])->name('adminEditProductForm')->middleware('restrictToAdmin');

// Display Product Image Form
Route::get('admin/editProductImageForm/{id}', [App\Http\Controllers\AdminProductsController::class, 'editProductImageForm'])->name('adminEditProductImageForm')->middleware('restrictToAdmin');

// Update Product Image
Route::post('admin/updateProductImage/{id}', [App\Http\Controllers\AdminProductsController::class, 'updateProductImage'])->name('adminUpdateProductImage')->middleware('restrictToAdmin');

// Update Product Details
Route::post('admin/updateProduct/{id}', [App\Http\Controllers\AdminProductsController::class, 'updateProduct'])->name('adminUpdateProduct')->middleware('restrictToAdmin');





// Display Create Product From
Route::get('admin/createProductForm', [App\Http\Controllers\AdminProductsController::class, 'createProductForm'])->name('adminCreateProductForm')->middleware('restrictToAdmin');

// Create New Product
Route::post('admin/newProductForm', [App\Http\Controllers\AdminProductsController::class, 'newProductForm'])->name('adminNewProductForm')->middleware('restrictToAdmin');

// Delete Product
Route::get('admin/deleteProduct/{id}', [App\Http\Controllers\AdminProductsController::class, 'deleteProduct'])->name('adminDeleteProduct')->middleware('restrictToAdmin');





// Contact Email
Route::get('email', [App\Http\Controllers\EmailController::class, 'sendmail'])->name('sendmail');
