<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function dashboard()
    {
        if(!auth()->user()->hasPermission('view.dashboard')){
            toastr()->error("Access Denied :(");
            return back();
        }

        $employeeRole = 'employee';
        $totalEmployee = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
            $roleTable->where('slug', $employeeRole);
        })->get();   

        $clientRole = 'client';
        $totalClient = User::whereHas('roles', function ($roleTable) use ($clientRole) {
            $roleTable->where('slug', $clientRole);
        })->get(); 
        $pendingShifts = Shift::where('status', 'Pending')->get();
        $completedShifts = Shift::where('status', 'Completed')->get();
        $totalShifts = Shift::count();

        return view('admin.dashboard', ['totalEmployee' => $totalEmployee, 'totalClient' => $totalClient, 'pendingShifts' => $pendingShifts, 'completedShifts' => $completedShifts, 'totalShifts' => $totalShifts]);
            

    }
}
