<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::view('/login', 'admin.login');
    Route::post('/login', [AdminController::class, 'login']);
});
