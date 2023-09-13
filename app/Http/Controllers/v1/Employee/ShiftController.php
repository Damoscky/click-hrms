<?php

namespace App\Http\Controllers\v1\Employee;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use App\Models\EmployeeShift;
use App\Notifications\EmployeeShiftNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index()
    {
        $currentInstantUser = auth()->user(); 

        $totalShifts = EmployeeShift::where('employee_id', $currentInstantUser->id)->get();
        return view('employee.all-shift', ['totalShifts' => $totalShifts]);
    }

    public function acceptShift($id)
    {   
        $id = base64_decode($id);

        $currentInstantUser = auth()->user(); 

        $employeeShift = EmployeeShift::where('id', $id)->where('employee_id', $currentInstantUser->id)->first();

        DB::beginTransaction();
        if(is_null($employeeShift)){
            toastr()->warning("Record not Found");
            return back();
        }

        $employeeShift->update([
            'status' => 'Accepted',
        ]);

        $adminRole = 'Workforce Admin Access';

        //send email to Admin
        $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
            $roleTable->where('name', $adminRole);
        })->pluck('email');

        $data = [
            'first_name' => $currentInstantUser->first_name,
            'last_name' => $currentInstantUser->last_name,
            'status' => "Accepted",
            'date' => $employeeShift->date,
        ];

         //send email to Admin
        //  Notification::route('mail', $superAdmins)->notify(new EmployeeShiftNotification($data));

        $dataToLog = [
            'causer_id' => $currentInstantUser->id,
            'action_id' => $employeeShift->id,
            'action_type' => "Models\EmployeeShift",
            'log_name' => "Employee accepted this a successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} accepted a shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        DB::commit();
        toastr()->success("Shift Accepted Successfully");
        return back();
    }

    public function currentShift()
    {
        $currentInstantUser = auth()->user(); 

        $totalShifts = EmployeeShift::where('employee_id', $currentInstantUser->id)->where('date', Carbon::today())->where('status', 'Accepted')->get();
        return view('employee.current-shift', ['totalShifts' => $totalShifts]);
    }

    public function clockIn($id)
    {
        $id = base64_decode($id);
        $userIpAddress = request()->ip();
        return getGeolocation($userIpAddress);
        return $employeeShift = EmployeeShift::find($id);
    }

    public function cancelShift($id)
    {   
        $id = base64_decode($id);

        $currentInstantUser = auth()->user(); 

        $employeeShift = EmployeeShift::where('id', $id)->where('employee_id', $currentInstantUser->id)->first();

        DB::beginTransaction();
        if(is_null($employeeShift)){
            toastr()->warning("Record not Found");
            return back();
        }

        $employeeShift->update([
            'status' => 'Cancelled',
        ]);

        $employeeShift->shift->update([
            'total_staff_assigned' => $employeeShift->shift->total_staff_assigned - 1,
            'status' => 'Pending'
        ]);

        $adminRole = 'Workforce Admin Access';

        //send email to Admin
        $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
            $roleTable->where('name', $adminRole);
        })->pluck('email');

        $data = [
            'first_name' => $currentInstantUser->first_name,
            'last_name' => $currentInstantUser->last_name,
            'status' => "Cancelled",
            'date' => $employeeShift->date,
        ];

         //send email to Admin
         Notification::route('mail', $superAdmins)->notify(new EmployeeShiftNotification($data));

        $dataToLog = [
            'causer_id' => $currentInstantUser->id,
            'action_id' => $employeeShift->id,
            'action_type' => "Models\EmployeeShift",
            'log_name' => "Employee cancelled a shift successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} cancelled a shift a successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        DB::commit();
        toastr()->success("Shift Cancelled Successfully");
        return back();
    }
}
