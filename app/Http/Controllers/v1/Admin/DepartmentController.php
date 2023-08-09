<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('admin.department.all-departments');
    }


    public function create()
    {
        return view('admin.department.create-department');
    }
}
