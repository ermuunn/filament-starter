<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'getCustomers']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'getCategories']);
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'getProducts']);
});
