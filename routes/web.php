<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'view')->name('home');
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login');
});

Route::controller(LogoutController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'view')->name('register');
    Route::post('/register', 'register');
});

Route::controller(AdminDashboardController::class)->group(function () {
    Route::get('/admin/dashboard', 'index')->name('admin.dashbaord');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('/admin/students', 'index')->name('admin.students');
    Route::get('/admin/student/create', 'create')->name('admin.student.create');
    Route::post('/admin/student/create', 'store');
    Route::get('/admin/student/{student}/edit', 'edit')->name('admin.student.edit');
    Route::post('/admin/student/{student}/edit', 'update');
    Route::get('/admin/student/{student}/destroy', 'destroy')->name('admin.student.destroy');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/admin/courses', 'index')->name('admin.courses');
    Route::get('/admin/course/create', 'create')->name('admin.course.create');
    Route::post('/admin/course/create', 'store');
    Route::get('/admin/course/{course}/edit', 'edit')->name('admin.course.edit');
    Route::post('/admin/course/{course}/edit', 'update');
    Route::get('/admin/course/{course}/destroy', 'destroy')->name('admin.course.destroy');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/admin/registrations', 'index')->name('admin.registrations');
    Route::get('/admin/registration/create', 'create')->name('admin.registration.create');
    Route::post('/admin/registration/create', 'store');
    Route::get('/admin/registration/{registration}/edit', 'edit')->name('admin.registration.edit');
    Route::post('/admin/registration/{registration}/edit', 'update');
    Route::get('/admin/registration/{registration}/destroy', 'destroy')->name('admin.registration.destroy');
});

Route::controller(StudentDashboardController::class)->group(function () {
    Route::get('/student/dashboard', 'index')->name('student.dashbaord');
});
