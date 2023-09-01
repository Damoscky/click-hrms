<?php

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\RegisterController;
use App\Http\Controllers\v1\Pages\PagesController;
use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Admin\DepartmentController;
use App\Http\Controllers\v1\Admin\EmployeeController AS AdminEmployeeController;
use App\Http\Controllers\v1\Employee\EmployeeController AS EmployeeController;
use App\Http\Controllers\v1\Employee\TimesheetController AS EmployeeTimesheetController;
use App\Http\Controllers\v1\Admin\ClientController;
use App\Http\Controllers\v1\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\v1\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\v1\Admin\TimesheetController;
use App\Http\Controllers\v1\Admin\StaffController;
use App\Http\Controllers\v1\Admin\ShiftController;
use App\Http\Controllers\v1\Admin\ReportController;
use App\Http\Controllers\v1\Admin\SettingController as AdminSettingController;
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
    Route::post('record/update', [EmployeeController::class, 'updatePersonalRecord'])->name('employee.record.update');
    Route::post('address/update', [EmployeeController::class, 'updateAddress'])->name('employee.address.update');
    Route::post('bank/details/update', [EmployeeController::class, 'updateBankDetails'])->name('employee.bankdetails.update');
    Route::post('nextofkin/update', [EmployeeController::class, 'updateNextOfKin'])->name('employee.nextofkin.update');
    Route::post('reference/update', [EmployeeController::class, 'updateEmployeeReference'])->name('employee.reference.update');
    Route::get('nextofkin/delete/{id}', [EmployeeController::class, 'deleteNextOfKin'])->name('employee.nextofkin.delete');
    Route::get('experience/delete/{id}', [EmployeeController::class, 'deleteExperience'])->name('employee.experience.delete');
    Route::post('experience/update', [EmployeeController::class, 'updateExperience'])->name('employee.experience.update');
    Route::post('document/upload', [EmployeeController::class, 'uploadDocument'])->name('employee.document.upload');
    Route::get('document/delete/{id}', [EmployeeController::class, 'deleteDocument'])->name('employee.document.delete');
    Route::get('application/sendforapproval', [EmployeeController::class, 'sendForApproval'])->name('employee.application.sendforapproval');
    Route::get('/complete/registration', [EmployeeController::class, 'completeRegistration'])->name('employee.complete-registration');

    Route::group(['prefix' => 'timesheet'], function(){
        Route::get('/', [EmployeeTimesheetController::class, 'index'])->name('employee.timesheet.all');
    });

    Route::group(['prefix' => 'availability'], function(){
        Route::get('/', [EmployeeTimesheetController::class, 'availability'])->name('employee.availability.all');
    });
});

//Client Route
Route::group(['prefix' => 'client', 'middleware' => ["auth:web", "client"]], function (){
    Route::get('/dashboard', [ClientDashboardController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/complete/registration', [ClientProfileController::class, 'completeRegistration'])->name('client.complete-registration');
    Route::post('/company/update', [ClientProfileController::class, 'updateBasicRecord'])->name('client.record.update');
    Route::post('/company/update/address', [ClientProfileController::class, 'updateAddress'])->name('client.record.address.update');

});



// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ["auth:web", "superadmin"]], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'department'], function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.all');
        Route::post('/create', [DepartmentController::class, 'create'])->name('admin.department.create');
        Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('admin.department.delete');
    });
    Route::group(['prefix' => 'settings'], function(){
        Route::get('/company', [AdminSettingController::class, 'index'])->name('admin.settings.company');
        Route::post('/company/update', [AdminSettingController::class, 'updateCompanySetting'])->name('admin.settings.company.update');
    });

    Route::group(['prefix' => 'reports'], function(){
        Route::get('/employee', [ReportController::class, 'employeeReports'])->name('admin.reports.employee');
        Route::post('/employee/generate', [ReportController::class, 'generateEmployeeReports'])->name('admin.reports.generate.employee');
        Route::post('/employee/export', [ReportController::class, 'exportEmployeeReports'])->name('admin.reports.export.employee');
    });

    Route::group(['prefix' => 'employee'], function(){
        Route::get('/', [AdminEmployeeController::class, 'index'])->name('admin.employee.all');
        Route::post('/search', [AdminEmployeeController::class, 'search'])->name('admin.employee.search');
        Route::get('/pending', [AdminEmployeeController::class, 'pendingApproval'])->name('admin.employee.pending');
        Route::post('/store', [AdminEmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/view/{id}', [AdminEmployeeController::class, 'show'])->name('admin.employee.show');
        Route::get('/approve/{id}', [AdminEmployeeController::class, 'approveEmployee'])->name('admin.employee.approve');
        Route::post('/disapprove/{id}', [AdminEmployeeController::class, 'declineEmployee'])->name('admin.employee.disapprove');
        Route::get('/availability', [AdminEmployeeController::class, 'availability'])->name('admin.employee.availability');
    });

    Route::group(['prefix' => 'staff'], function(){
        Route::get('/', [StaffController::class, 'index'])->name('admin.staff.all');
    });

    Route::group(['prefix' => 'clients'], function(){
        Route::post('/create', [ClientController::class, 'store'])->name('admin.client.create');
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


