<?php

namespace App\Http\Controllers\v1\Employee;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use App\Models\EmployeeShift;
use App\Models\User;
use Illuminate\Http\Request;

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

        if(is_null($employeeShift)){
            toastr()->warning("Record not Found");
            return back();
        }

        $employeeShift->update([
            'status' => 'Accepted',
        ]);

        $dataToLog = [
            'causer_id' => $currentInstantUser->id,
            'action_id' => $employeeShift->id,
            'action_type' => "Models\EmployeeShift",
            'log_name' => "Employee accepted this a successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} accepted a shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Shift Accepted Successfully");
        return back();
    }

    public function cancelShift($id)
    {   
        $id = base64_decode($id);

        $currentInstantUser = auth()->user(); 

        $employeeShift = EmployeeShift::where('id', $id)->where('employee_id', $currentInstantUser->id)->first();

        if(is_null($employeeShift)){
            toastr()->warning("Record not Found");
            return back();
        }

        $employeeShift->update([
            'status' => 'Cancelled',
        ]);

        $adminRole = 'Workforce';

        //send email to Admin
        $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
            $roleTable->where('name', $adminRole);
        })->pluck('email');

         //send email to Admin
         Notification::route('mail', $superAdmins)->notify(new SentForApprovallNotification($record));

        $dataToLog = [
            'causer_id' => $currentInstantUser->id,
            'action_id' => $employeeShift->id,
            'action_type' => "Models\EmployeeShift",
            'log_name' => "Employee cancelled a shift successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} cancelled a shift a successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Shift Cancelled Successfully");
        return back();
    }
}
