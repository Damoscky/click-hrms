<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{

    public function index()
    {
        $activeDepartments = Department::where('is_active', true)->count();
        $inactiveDepartments = Department::where('is_active', false)->count();
        $departments = Department::all();

        return view('admin.department.all-departments', ['departments' => $departments, 'activeDepartments' => $activeDepartments, 'inactiveDepartments' => $inactiveDepartments]);
    }


    public function create()
    {
        return view('admin.department.create-department');
    }
}
