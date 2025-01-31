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
        Route::post('faculty/batch/subject/show',[FacultyController::class,'showDegreeSubject']);
        Route::delete('faculty/batch/subject/delete/{id}',[FacultyController::class,'deleteDegreeSubject'])->name('degreeSubject.delete');
        //Syllabus Content Module
        Route::resource('syllabus-content', SyllabusContentController::class);
        Route::get('syllabus/get/batch/{id}',[SyllabusContentController::class,'getBatch']);
        Route::get('syllabus/get/batch-type/{id}',[SyllabusContentController::class,'getSemesterByBatch']);
        Route::post('syllabus/get/type/semester',[SyllabusContentController::class,'getSemesterByType']);
        Route::post('syllabus/get/type/semester/subject',[SyllabusContentController::class,'getSubject']);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
    });
});
