<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTimesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = EmployeeTimesheet::with('employee', 'shift')->orderBy('created_at', 'DESC')->get();

        return view('admin.timesheet.all-timesheet');
    }
}
