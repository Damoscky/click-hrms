<?php

namespace App\Http\Controllers\v1\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        return view('employee.dashboard');
    }

    public function completeRegistration()
    {
        return view('employee.complete-registration');
    }
}
