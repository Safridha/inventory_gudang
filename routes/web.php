<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| HOME REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('categories.index');
});

/*
|--------------------------------------------------------------------------
| CATEGORY ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit');

Route::post('/categories', [CategoryController::class, 'store'])
    ->name('categories.store');

Route::put('/categories/{id}', [CategoryController::class, 'update'])
    ->name('categories.update');

Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');

/*
|--------------------------------------------------------------------------
| PRODUCT ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

Route::put('/products/{id}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy');