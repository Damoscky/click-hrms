<?php

namespace App\Http\Controllers\v1\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }

        return view('employee.timesheet');
    }

    public function availability()
    {
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }
        
        return view('employee.availability');
    }
}
