<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Post\PostsController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('isLogin')->group(function(){
    Route::get('/',[AuthController::class,'login'])->name('auth.login');
    Route::post('/',[AuthController::class,'loginStore'])->name('auth.store');
    Route::get('/admin/register',[AuthController::class,'register'])->name('auth.admin.register');
    Route::post('/admin/register',[AuthController::class,'registerStore'])->name('auth.admin.register.store');
    Route::post('/auth/password',[AuthController::class,'registerAuthPassword']);
});

Route::middleware('auth')->group(function(){
    Route::get('admin/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::resource('admin/post',PostsController::class)->except(['create','show']);
    Route::get('admin/logout',[AuthController::class,'logout'])->name('logout');
});