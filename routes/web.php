<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::view('/login', 'admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/panel', [AdminController::class, 'panel'])->middleware('admin')->name('admin.panel');
});

Route::prefix('products')->group(function () {
    Route::post('/store', [ProductController::class, 'store'])->middleware('admin')->name('products.store');
    Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->middleware('admin')->name('products.destroy');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
