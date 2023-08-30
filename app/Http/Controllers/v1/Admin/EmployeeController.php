<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreateEmployeeNotification;
use App\Notifications\ApproveEmployeeNotification;
use App\Notifications\DeclineEmployeeNotification;
use App\Helpers\ProcessAuditLog;
use App\Models\EmployeeDisapproval;
use Carbon\Carbon;
use Auth, Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('view.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $userRole = 'employee';
            // $recordSearchParam = $request->searchByDate;
        $employeeRole = 'employee';
        $totalEmployees = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
            $roleTable->where('slug', $employeeRole);
        })->where('status', 'Approved')->where('is_active', true)->get();
        $departments = Department::where('is_active', true)->get();
        return view('admin.employee.all-employees', ['departments' => $departments, 'totalEmployees' => $totalEmployees]);
    }

    public function search(Request $request)
    {
        $employeeRole = 'employee';
        $departmentSearchParam = $request->department_id;
        $employeeNameSearchParam = $request->employee_name;
        $employeeIdSearchParam = $request->employee_id;
        (!is_null($request->start_date) && !is_null($request->end_date)) ? $dateSearchParams = true : $dateSearchParams = false;

        $records = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
            $roleTable->where('slug', $employeeRole);
        })->when($departmentSearchParam, function ($query, $departmentSearchParam) use ($request) {
            return $query->whereHas('employeeRecord', function($query) use ($departmentSearchParam){
                return $query->where('department_id', $departmentSearchParam);
            });
        })->when($employeeNameSearchParam, function ($query, $employeeNameSearchParam) use ($request) {
                return $query->where('first_name', 'LIKE', '%'. $employeeNameSearchParam .'%')
                ->orWhere('last_name', 'LIKE', '%' .$employeeNameSearchParam. '%');
        })->when($employeeIdSearchParam, function ($query, $employeeIdSearchParam) use ($request) {
            return $query->whereHas('employeeRecord', function($query) use ($employeeIdSearchParam){
                return $query->where('employee_id', $employeeIdSearchParam);
            });
        })->when($dateSearchParams, function($query, $dateSearchParams) use($request) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            return $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
        })
        ->where('status', 'Approved')->where('is_active', true)->get();

        $departments = Department::orderBy('name', 'DESC')->get();
        return $records;

        return view('admin.employee.all-employees', ['departments' => $departments, 'totalEmployees' => $records]);

        
    }

    public function pendingApproval()
    {
        if(!auth()->user()->hasPermission('view.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $employeeRole = 'employee';
            // $recordSearchParam = $request->searchByDate;

        $totalEmployees = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
            $roleTable->where('slug', $employeeRole);
        })->where('status', 'Review')->where('sent_for_approval', true)->get();
        $departments = Department::where('is_active', true)->get();
        return view('admin.employee.pending-employees', ['departments' => $departments, 'totalEmployees' => $totalEmployees]);
    }


    public function show($id)
    {
        if(!auth()->user()->hasPermission('view.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $id = base64_decode($id);
        $record = User::find($id);

        if(is_null($record)){

            toastr()->error("Record not found");
            return back();
        }
        return view('admin.employee.view-employee', ['employee' => $record]);
    }

    public function approveEmployee($id)
    {
        if(!auth()->user()->hasPermission('edit.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $id = base64_decode($id);
        $record = User::find($id);

        if(is_null($record)){
            toastr()->error("Record not found");
            return back();
        }
        $record->update([
            'status' => 'Approved',
            'is_completed' => true,
            'is_active' => true
        ]);

        $userInstance = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\User",
            'log_name' => "User application approved successfully",
            'description' => "{$userInstance->first_name} {$userInstance->last_name} approved {$record->first_name} {$record->last_name} application successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        //sendemail to notify employee
        Notification::route('mail', $record->email)->notify(new ApproveEmployeeNotification($record));

        toastr()->success("Employee activated succcessfully");
        return back();
    }

    public function declineEmployee(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $id = base64_decode($id);
        $record = User::find($id);

        if(is_null($record)){
            toastr()->error("Record not found");
            return back();
        }
        $record->update([
            'status' => 'Declined',
            'is_completed' => false,
            'is_active' => false,
            'sent_for_approval' => false,
        ]);

        $reason = EmployeeDisapproval::create([
            'declined_by' => auth()->user()->id,
            'employee_id' => $record->id,
            'reason' => $request->reason
        ]);

        $userInstance = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\User",
            'log_name' => "User application declined successfully",
            'description' => "{$userInstance->first_name} {$userInstance->last_name} declined {$record->first_name} {$record->last_name} application successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        //sendemail to notify employee
        Notification::route('mail', $record->email)->notify(new DeclineEmployeeNotification($record));

        toastr()->success("Employee disapproved succcessfully");
        return back();
    }

    public function availability()
    {
        return view('admin.employee.availability');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $validateRequest = $this->validateEmployeeRequest($request);

        if($validateRequest->fails()){
            toastr()->error($validateRequest->errors()->first());
            return back();
        }
        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phoneno' => $request->phone_number,
                'email' => $request->email,
                'first_name' => $request->first_name,
            ]);

            $verification_code = Str::random(30); //Generate verification code

            DB::table('password_resets')->where('email', $user->email)->delete();

            DB::table('password_resets')->insert(['email' => $user->email, 'token' => $verification_code, 'created_at' => Carbon::now()]);


            //get role
            $role = Role::where('slug', 'employee')->first();

            if(isset($user) && isset($role)){
                $user->attachRole($role);

                $rand_no = mt_rand(0000,99999);
                $employee_id = 'CLK-'. $rand_no  . '-' .$request->first_name[0] .$request->last_name[0];

                $employeeRecord = EmployeeRecord::create([
                    'resumption_date' => $request->resumption_date,
                    'user_id' => $user->id,
                    'department_id' => $request->department_id,
                    'gender' => $request->gender,
                    'phoneno' => $request->phone_number,
                    'employee_id' => $employee_id
                ]);
            }

            $data = [
                'name' => $request->first_name,
                'email' => $user->email,
                'verification_code' => $verification_code,
            ];

            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => $user->id,
                'action_type' => "Models\User",
                'log_name' => "Employee Created successfully",
                'description' => "{$user->first_name} {$user->last_name} account created successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            //send notification to user
            Notification::route('mail', $user->email)->notify(new CreateEmployeeNotification($data));

            DB::commit();

            toastr()->success("Record created successfully. Email notification sent to employee");
            return back();

        } catch (\Throwable $error) {
            DB::rollBack();
            toastr()->error($error->getMessage());
            return back();
        }


    }

    

    public function validateEmployeeRequest($request)
    {
        $rules = [
            'email' => 'required|confirmed|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'resumption_date' => 'required',
            'phone_number' => 'required|unique:users,phoneno',
            'gender' => 'required',
            'department_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function completeRegistration(Request $request, $token)
    {
        $email = $request->email;
        $validateRecord = DB::table('password_resets')->where('email', $email)->where('token', $token)->first();

        if(is_null($validateRecord) || !$token){
            toastr()->error("Invalid token!");
            return redirect()->route('index');
        }
        $user = User::where('email', $validateRecord->email)->first();

        $data = [
            'user' => $user,
            'token' => $validateRecord,
        ];

        return view('employee.complete-registration', ['data' => $data]);
    }

    
}
