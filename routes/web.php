<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::view('/login', 'admin.login', ['title' => 'Login']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/panel', [AdminController::class, 'panel'])->middleware('admin')->name('admin.panel');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])->name('products.list');
    Route::post('/', [ProductController::class, 'store'])->middleware('admin')->name('products.store');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->middleware('admin')->name('products.destroy');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
