<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.all-employees');
    }


    public function show()
    {
        return view('admin.employee.view-employee');
    }

    public function availability()
    {
        return view('admin.employee.availability');
    }
}
