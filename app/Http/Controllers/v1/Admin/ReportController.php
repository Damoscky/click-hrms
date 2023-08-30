<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function employeeReports()
    {
        if (!auth()->user()->hasPermission('view.reports')) {

            toastr()->error("Access Denied :(");
            return back();
        }

        $departments = Department::orderBy('name', 'DESC')->get();
        $records = [];

        return view('admin.report.employee-report', ['departments' => $departments, 'records' => $records]);
    }

    public function generateEmployeeReports(Request $request)
    {
        $employeeRole = 'employee';
        $departmentSearchParam = $request->department;
        (!is_null($request->start_date) && !is_null($request->end_date)) ? $dateSearchParams = true : $dateSearchParams = false;

        if(isset($request->department) && $request->department == "All"){
            $records = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
                $roleTable->where('slug', $employeeRole);
            })->when($dateSearchParams, function($query, $dateSearchParams) use($request) {
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);
                return $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
            })
            ->get();
        }else{
            $records = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
                $roleTable->where('slug', $employeeRole);
            })->when($departmentSearchParam, function ($query, $departmentSearchParam) use ($request) {
                return $query->whereHas('employeeRecord', function($query) use ($departmentSearchParam){
                    return $query->where('department_id', $departmentSearchParam);
                });
            })->when($dateSearchParams, function($query, $dateSearchParams) use($request) {
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);
                return $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
            })
            ->get();
        }

        $departments = Department::orderBy('name', 'DESC')->get();

        return view('admin.report.employee-report', ['departments' => $departments, 'records' => $records]);

        
    }


    public function exportEmployeeReports(Request $request)
    {
        return $request;
    }
}
