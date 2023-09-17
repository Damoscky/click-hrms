<?php

namespace App\Http\Controllers\v1\Employee;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use App\Models\EmployeeShift;
use App\Models\EmployeeTimesheet;
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
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }

        $currentInstantUser = auth()->user(); 

        $totalShifts = EmployeeShift::where('employee_id', $currentInstantUser->id)->get();
        return view('employee.all-shift', ['totalShifts' => $totalShifts]);
    }

    public function acceptShift($id)
    {   
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }

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
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }

        $currentInstantUser = auth()->user(); 

        $totalShifts = EmployeeShift::where('employee_id', $currentInstantUser->id)->where('date', Carbon::today())->where('status', 'Accepted')->get();
        return view('employee.current-shift', ['totalShifts' => $totalShifts]);
    }

    public function clockIn($id)
    {
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }

       try {
            $id = base64_decode($id);
            $employeeShift = EmployeeShift::find($id);
            $currentDateTime = Carbon::now();
            $clockInTime = $currentDateTime->format('H:i:s');

            DB::beginTransaction();
            //create timesheet
            $timesheet = EmployeeTimesheet::firstOrCreate([
                'client_id' => $employeeShift->shift->client_id,
                'employee_id' => auth()->user()->id,
                'shift_id' => $employeeShift->shift_id,
                'time_in' => $clockInTime,
                'clock_in' => true,
                'clock_in_date' => $currentDateTime,
            ]);

            $employeeShift->update([
                'clock_in' => true 
            ]);

            DB::commit();
            toastr()->success("You've started your shift Successfully");
            return back(); 
       } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back(); 
       }      

    }

    public function cancelShift($id)
    {   
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete your registration!");
            return redirect()->route('employee.complete-registration');
        }
        if (!auth()->user()->is_verified) {
            toastr()->success("Your information is current under review!");
            return redirect()->route('employee.complete-registration');
        }
        
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
