<?php

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\RegisterController;
use App\Http\Controllers\v1\Pages\PagesController;
use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Admin\DepartmentController;
use App\Http\Controllers\v1\Admin\EmployeeController AS AdminEmployeeController;
use App\Http\Controllers\v1\Employee\EmployeeController AS EmployeeController;
use App\Http\Controllers\v1\Admin\ClientController;
use App\Http\Controllers\v1\Admin\TimesheetController;
use App\Http\Controllers\v1\Admin\StaffController;
use App\Http\Controllers\v1\Admin\ShiftController;
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
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('/reset/password', [LoginController::class, 'resetPassword'])->name('auth.reset-password');
    Route::get('/reset-password/{token}', [LoginController::class, 'createPasswordPage'])->name('auth.create-password');
    Route::post('/create-new-password', [LoginController::class, 'createPassword'])->name('auth.create-new-password');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('/forget-password', [LoginController::class, 'forgetPasswordPage'])->name('auth.forget-password');
});

//Employee Route
Route::group(['prefix' => 'employee', 'middleware' => ["auth:web", "employee"]], function (){
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/complete/registration', [EmployeeController::class, 'completeRegistration'])->name('employee.complete-registration');
});



// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ["auth:web", "superadmin"]], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'department'], function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.all');
        Route::get('/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    });

    Route::group(['prefix' => 'employee'], function(){
        Route::get('/', [AdminEmployeeController::class, 'index'])->name('admin.employee.all');
        Route::post('/store', [AdminEmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/view', [AdminEmployeeController::class, 'show'])->name('admin.employee.show');
        Route::get('/availability', [AdminEmployeeController::class, 'availability'])->name('admin.employee.availability');
    });

    Route::group(['prefix' => 'staff'], function(){
        Route::get('/', [StaffController::class, 'index'])->name('admin.staff.all');
    });

    Route::group(['prefix' => 'clients'], function(){
        Route::get('/', [ClientController::class, 'index'])->name('admin.client.all');
        Route::get('/view', [ClientController::class, 'show'])->name('admin.client.show');
    });

    Route::group(['prefix' => 'timesheet'], function(){
        Route::get('/', [TimesheetController::class, 'index'])->name('admin.timesheet.all');
    });

    Route::group(['prefix' => 'shifts'], function(){
        Route::get('/', [ShiftController::class, 'index'])->name('admin.shift.all');
        Route::get('/pending', [ShiftController::class, 'pendingShifts'])->name('admin.shift.pending');
        Route::get('/assigned', [ShiftController::class, 'assignedShifts'])->name('admin.shift.assigned');
    });


});


