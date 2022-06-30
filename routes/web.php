<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\VoucherController;

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
//FE
Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

//Category Home
Route::get('/category-product-home/{category_id}', [CategoryProductController::class, 'showCategoryProduct']);

//Brand Home
Route::get('/brand-product-home/{brand_id}', [BrandProductController::class, 'showBrandProduct']);

//BE
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'showDashboard']);

Route::get('/logout', [AdminController::class, 'log_out']);

Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//myprofile
Route::get('/myprofile', [AdminController::class, 'showMyProfile']);

//Category Product
Route::get('/add-category-product', [CategoryProductController::class, 'addCategoryProduct']);

Route::get('/edit-category-product/{category_product_id}', [CategoryProductController::class, 'editCategoryProduct']);

Route::post('/update-category-product/{category_product_id}', [CategoryProductController::class, 'updateCategoryProduct']);

Route::get('/delete-category-product/{category_product_id}', [CategoryProductController::class, 'deleteCategoryProduct']);

Route::get('/all-category-product', [CategoryProductController::class, 'allCategoryProduct']);

Route::post('/save-category-product', [CategoryProductController::class, 'saveCategoryProduct']);

Route::get('/active-category-product/{category_product_id}', [CategoryProductController::class, 'activeCategoryProduct']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactiveCategoryProduct']);

//Brand Product
Route::get('/add-brand-product', [BrandProductController::class, 'addBrandProduct']);

Route::get('/edit-brand-product/{brand_product_id}', [BrandProductController::class, 'editBrandProduct']);

Route::post('/update-brand-product/{brand_product_id}', [BrandProductController::class, 'updateBrandProduct']);

Route::get('/delete-brand-product/{brand_product_id}', [BrandProductController::class, 'deleteBrandProduct']);

Route::get('/all-brand-product', [BrandProductController::class, 'allBrandProduct']);

Route::post('/save-brand-product', [BrandProductController::class, 'saveBrandProduct']);

Route::get('/active-brand-product/{brand_product_id}', [BrandProductController::class, 'activeBrandProduct']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProductController::class, 'unactiveBrandProduct']);

//Product
Route::get('/add-product', [ProductController::class, 'addProduct']);

Route::get('/edit-product/{product_id}', [ProductController::class, 'editProduct']);

Route::post('/update-product/{product_id}', [ProductController::class, 'updateProduct']);

Route::get('/delete-product/{product_id}', [ProductController::class, 'deleteProduct']);

Route::get('/all-product', [ProductController::class, 'allProduct']);

Route::post('/save-product', [ProductController::class, 'saveProduct']);

Route::get('/active-product/{product_id}', [ProductController::class, 'activeProduct']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactiveProduct']);

//Product Detail
Route::get('/product-detail/{product_id}', [ProductController::class, 'productDetail']);

//Cart
Route::post('/save-cart', [CartController::class, 'saveCart']);
Route::get('/show-cart', [CartController::class, 'showCart']);
Route::get('/delete-cart/{rowId}', [CartController::class, 'deleteCart']);
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity']);

//Checkout
Route::get('/login-checkout', [CheckoutController::class, 'loginCheckOut']);
Route::post('/login-customer', [CheckoutController::class, 'loginCustomer']);
Route::get('/show-checkout', [CheckoutController::class, 'checkOut']);
Route::post('/save-checkout', [CheckoutController::class, 'saveCheckOut']);
Route::get('/logout-checkout', [CheckoutController::class, 'logoutCheckOut']);

//Customer
Route::post('/add-customer', [CheckoutController::class, 'addCustomer']);

//Payment
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/order-place', [CheckoutController::class, 'orderPlace']);

//Search
Route::post('/search', [HomeController::class, 'search']);

//Manage order
Route::get('/manage-order', [CheckoutController::class, 'manageOrder']);

Route::get('/view-order/{order_id}', [CheckoutController::class, 'viewOrder']);

Route::get('/delete-order/{order_id}', [CheckoutController::class, 'deleteOrder']);


//Send Mail
Route::get('/send-mail', [HomeController::class, 'sendMail']);

//Login Facebook
Route::get('/login-facebook', [AdminController::class, 'loginFacebook']);
Route::get('/callback-facebook', [AdminController::class, 'callbackFacebook']);

//Login Google
Route::get('/login-google', [AdminController::class, 'loginGoogle']);
Route::get('/admin/google/callback', [AdminController::class, 'callbackGoogle']);

//Check voucher
Route::post('/check-voucher', [VoucherController::class, 'checkVoucher']);
Route::get('/add-voucher', [VoucherController::class, 'addVoucher']);
Route::get('/all-voucher', [VoucherController::class, 'allVoucher']);
Route::post('/save-voucher', [VoucherController::class, 'saveVoucher']);
Route::get('/delete-voucher/{voucher_id}', [VoucherController::class, 'deleteVoucher']);