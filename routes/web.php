<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryProductController;


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

//BE
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'showDashboard']);

Route::get('/logout', [AdminController::class, 'log_out']);

Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Category Product
Route::get('/add-category-product', [CategoryProductController::class, 'addCategoryProduct']);

Route::get('/all-category-product', [CategoryProductController::class, 'allCategoryProduct']);

Route::post('/save-category-product', [CategoryProductController::class, 'saveCategoryProduct']);
