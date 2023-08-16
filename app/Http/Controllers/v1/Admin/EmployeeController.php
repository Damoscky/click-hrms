<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('view.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $departments = Department::where('is_active', true)->get();
        return view('admin.employee.all-employees', ['departments' => $departments]);
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
