<?php

namespace App\Http\Controllers\v1\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return view('employee.timesheet');
    }

    public function availability()
    {
        return view('employee.availability');
    }
}
