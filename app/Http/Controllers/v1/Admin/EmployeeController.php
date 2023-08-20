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
use App\Helpers\ProcessAuditLog;
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

        $totalCustomers = User::whereHas('roles', function ($roleTable) use ($userRole) {
            $roleTable->where('name', $userRole);
        })->get();
        $departments = Department::where('is_active', true)->get();
        return view('admin.employee.all-employees', ['departments' => $departments, 'totalCustomers' => $totalCustomers]);
    }


    public function show()
    {
        return view('admin.employee.view-employee');
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
