<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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


Route::get('/login', [AuthController::class, 'index'])->name('show-form-login');
Route::post('/login/attempt', [AuthController::class, 'attempt'])->name('login');

Route::get('/test', [ProductController::class, 'test'])->name('test');
Route::post('/test', [ProductController::class, 'test']);

Route::group(['prefix' => '/','middleware' => 'adminauth'], function () {
    // Admin Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
    

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category');
    Route::prefix('category')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    });

    Route::get('/products', [ProductController::class, 'index'])->name('admin.product');
    Route::prefix('product')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    });

    Route::get('/bills', [BillController::class, 'index'])->name('admin.bill');
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.message');
    

    
    Route::post('/register/store', [AuthController::class, 'store'])->name('register');
});