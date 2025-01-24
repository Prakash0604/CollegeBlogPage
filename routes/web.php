<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\Post\PostsController;
use App\Http\Controllers\Admin\SyllabusContentController;
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

Route::middleware('auth')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::resource('post',PostsController::class)->except(['create','show']);
        Route::get('post/image/delete/{id}',[PostsController::class,'deleteImage']);

        Route::resource('faculty', FacultyController::class);
        Route::get('faculty/status/{id}', [FacultyController::class,'toggleStatus']);
        Route::get('faculty/batch/type/{data}', [FacultyController::class,'getFacultySemester']);
        Route::post('faculty/batch/subject', [FacultyController::class,'storeSubject']);
        //Syllabus Content Module
        Route::resource('syllabus-content', SyllabusContentController::class);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
    });
});
