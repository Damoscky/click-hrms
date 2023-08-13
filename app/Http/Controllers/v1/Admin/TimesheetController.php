<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return view('admin.timesheet.all-timesheet');
    }
}
