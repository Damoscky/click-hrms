<?php

namespace App\Http\Controllers\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTimesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        try {
            $timesheets = EmployeeTimesheet::with('employee', 'shift')->where('client_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
            return view('client.timesheet.timesheet', ['timesheets' => $timesheets]);
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back(); 
        }
    }
}
