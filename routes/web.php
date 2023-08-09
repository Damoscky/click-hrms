<?php

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Pages\PagesController;
use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Admin\DepartmentController;
use App\Http\Controllers\v1\Admin\EmployeeController;
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

Route::get('/', [PagesController::class, 'index'])->name('index');


Route::group(['prefix' => 'auth'], function (){
    Route::get('/login', [LoginController::class, 'loginPage'])->name('auth.login-page');
    Route::get('/forget-password', [LoginController::class, 'forgetPasswordPage'])->name('auth.forget-password');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'department'], function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.all');
        Route::get('/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    });

    Route::group(['prefix' => 'employee'], function(){
        Route::get('/', [EmployeeController::class, 'index'])->name('admin.employee.all');
    });

});

