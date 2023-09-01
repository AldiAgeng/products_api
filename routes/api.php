<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// Category Products
Route::prefix('category-products')->middleware('auth:sanctum')->name('category-products')->group(function () {
    Route::get('/', [CategoryProductController::class, 'all'])->name('all');
    Route::get('/{id}', [CategoryProductController::class, 'show'])->name('show');
    Route::post('/', [CategoryProductController::class, 'create'])->name('create');
    Route::patch('/{id}', [CategoryProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryProductController::class, 'destroy'])->name('destroy');
});

// Products
Route::prefix('products')->middleware('auth:sanctum')->name('products')->group(function () {
    Route::get('/', [ProductController::class, 'all'])->name('all');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('/', [ProductController::class, 'create'])->name('create');
    Route::post('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
});
