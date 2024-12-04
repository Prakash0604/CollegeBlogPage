<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\EventManagement\EventManagementController;
use App\Http\Controllers\Admin\Post\PostsController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('isLogin')->group(function () {
    // Authentication Routes
    Route::get('/', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/', [AuthController::class, 'loginStore'])->name('auth.store');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.admin.register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('auth.admin.register.store');
    Route::post('/password', [AuthController::class, 'registerAuthPassword']);
});

Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Resource Routes for Post
    Route::resource('post', PostsController::class)->except(['create', 'show']);

    // Resource Routes for Event Management
    Route::resource('eventmanagement', EventManagementController::class);
});
