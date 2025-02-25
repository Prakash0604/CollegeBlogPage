<?php

use App\Http\Controllers\Admin\calendar\CalendarController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\Menu\MenuController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\Post\PostsController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\SyllabusContentController;
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
    Route::prefix('admin')->group(function(){
        Route::resource('menu', MenuController::class);
        Route::get('menu/status/{id}',[MenuController::class,'toggleStatus']);

        Route::resource('role',RoleController::class);
        Route::get('role/status/{id}',[RoleController::class,'toggleStatus']);
        Route::post('role/menu/access',[PermissionController::class,'giveMenuAccess']);
        Route::get('role/already/assigned/data/{id}',[PermissionController::class,'excludeMenu']);
        Route::get('role/menu/list/{id}',[PermissionController::class,'getRoleBaseMenu']);
        Route::get('role/menu/remove/{id}',[PermissionController::class,'removeRoleBaseMenu']);

        Route::get('permission/{id}',[PermissionController::class,'index'])->name('admin.permission');
        Route::post('permission/update/status',[PermissionController::class,'updateStatus']);

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

       Route::resource('event', EventController::class);
       Route::get('event/sheduled/delete/{id}',[EventController::class,'deleteSheduled']);
       Route::get('calendar',[CalendarController::class,'index'])->name('calendar');
       Route::get('event/calendar/get',[EventController::class,'getEvent'])->name('calendar.events');

       Route::resource('student', StudentController::class);
    });
});
