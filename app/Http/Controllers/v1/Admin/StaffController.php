<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class StaffController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('view.staff')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $roles = Role::all();
        return view('admin.staff.all-staffs', ['roles' => $roles]);
    }
}
