<?php

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Pages\PagesController;
use App\Http\Controllers\v1\Admin\AdminController;
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
});

