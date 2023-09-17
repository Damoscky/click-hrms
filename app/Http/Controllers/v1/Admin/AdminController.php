<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeShift;
use App\Models\EmployeeTimesheet;
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
        $topClients = User::whereRelation('roles', 'slug', $clientRole)
        ->whereHas('shifts')->take(5)->get(); 

        $recentTimesheet = EmployeeTimesheet::with('employee', 'shift')->orderBy('created_at', 'DESC')->take(2)->get();
        $topPerformingEmployees = User::whereRelation('roles', 'slug', $employeeRole)
                        ->whereHas('employeeshifts', function ($query) {
                            // $query->where('status', 'Completed');
                        })
                        ->withCount(['employeeshifts' => function ($query) {
                            $query->where('status', 'Completed');
                        }])
                        ->orderByDesc('employeeshifts_count')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', ['topPerformingEmployees' => $topPerformingEmployees, 'recentTimesheet' => $recentTimesheet, 'totalEmployee' => $totalEmployee, 'totalClient' => $totalClient, 'topClients'=> $topClients, 'pendingShifts' => $pendingShifts, 'completedShifts' => $completedShifts, 'totalShifts' => $totalShifts]);
            

    }
}
