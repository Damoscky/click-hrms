<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ProcessAuditLog;
use App\Models\EmployeeAvailability;
use App\Models\EmployeeShift;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewShiftNotification;
use App\Notifications\AssignEmployeeShiftNotification;
use App\Notifications\AssignClientShiftNotification;
use App\Models\User;
use Carbon\Carbon;
use DB;

class ShiftController extends Controller
{
    public function index()
    {
        $totalShifts = Shift::get();
        $clientRole = 'client';
        $totalClients = User::whereHas('roles', function ($roleTable) use ($clientRole) {
            $roleTable->where('slug', $clientRole);
        })->get(); 
        return view('admin.shift.all-shift', ['totalShifts' => $totalShifts, 'totalClients' => $totalClients]);
    }

    public function pendingShifts()
    {
        $companySettings = CompanySetting::first();
        $totalShifts = Shift::where('status', 'Pending')->get();
        // return $employeeAvailability = \App\Models\EmployeeAvailability::with('employee')->whereDate('date', \Carbon\Carbon::parse($shift->data))->get();
        return view('admin.shift.pending-shift', ['totalShifts' => $totalShifts, 'companySettings' => $companySettings]);
    }

    public function requestShift(Request $request)
    {
        if(!auth()->user()->hasPermission('create.shift')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $validateRequest = $this->validateShiftRequest($request);

        if($validateRequest->fails()){
            toastr()->error($validateRequest->errors()->first());
            return back();
        }

        DB::beginTransaction();

        // $clientRecord = auth()->user()->clientRecord;

        // Get the arrays of data from the request
        $types = $request->input('type');
        $periods = $request->input('period');
        $totalStaff = $request->input('total_staff');
        $shiftDates = $request->input('shift_date');
        $startTimes = $request->input('start_time');
        $endTimes = $request->input('end_time');
        $clientIds = $request->input('client_id');
        $bankHoliday = $request->input('bank_holiday');

        // Loop through the data arrays and insert records
        foreach ($types as $key => $type) {

            //check for type and rate

            // Create a new Shift model or use your existing model
            $shift = new Shift();

            // Assign values from the arrays
            $shift->client_id = $clientIds[$key];
            $shift->rate = '15.5';
            $shift->type = $type;
            $shift->period = $periods[$key];
            $shift->total_staff = $totalStaff[$key];
            $shift->date = $shiftDates[$key];
            $shift->start_time = $startTimes[$key];
            $shift->end_time = $endTimes[$key];
            $shift->status = 'Pending';
            $shift->bank_holiday = isset($bankHoliday[$key]) ? 1 : 0;

            // Save the record to the database
            $shift->save();
        }

        //send email notification to admin
        $adminRole = ['Super Admin', 'Admin', 'Workforce Admin Access'];

        $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
            $roleTable->whereIn('name', $adminRole);
        })->pluck('email');

        //send email to Admin
        // Notification::route('mail', $superAdmins)->notify(new NewShiftNotification($clientRecord));
        $currentInstantUser = auth()->user();
        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $shift->id,
            'action_type' => "Models\Shift",
            'log_name' => "Shift Created successfully",
            'action' => 'Create',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} submitted a new shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        DB::commit();
        toastr()->success("Shift created successfully.");
        return back();
    }

    public function updateShift(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit.shift')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $validateRequest = $this->validateShiftRequest($request);

        if($validateRequest->fails()){
            toastr()->error($validateRequest->errors()->first());
            return back();
        }
        $id = base64_decode($id);

        $shift = Shift::find($id);
        if(is_null($shift)){
            toastr()->error("Record not found");
            return back();
        }

        $shift->update([
            'rate' => '15.5',
            'type' => $request->type,
            'period' => $request->period,
            'total_staff' => $request->total_staff,
            'date' => $request->shift_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'bank_holiday' => isset($request->bank_holiday) ? 1 : 0,
        ]);

        $currentInstantUser = auth()->user();
        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $shift->id,
            'action_type' => "Models\Shift",
            'log_name' => "Shift updated successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} updated a shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Record updated successfully.");
        return back();

    }

    public function cancelShifts($id)
    {
        $id = base64_decode($id);

        $currentInstantUser = auth()->user();

        $record = Shift::where('id', $id)->first();

        if(is_null($record)){
            toastr()->error("Record not found");
            return back();
        }

        //check if shift is less than 24hours
        // return now();
        $shiftDate = Carbon::createFromFormat('Y-m-d', $record->date);
        // Get the current date and time
        $currentDateTime = Carbon::now();

        // Calculate the date and time 24 hours ago
        $twentyFourHoursAgo = $currentDateTime->subHours(24);
        // Check if $dateToCheck is less than 24 hours ago
        
        $record->update([
            'status' => 'Cancelled',
        ]);

        $currentInstantUser = auth()->user();
        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\Shift",
            'log_name' => "Shift Cancelled successfully",
            'action' => 'Update',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} cancelled a shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Shift cancelled successfully");
        return back();


    }

    public function validateShiftRequest($request)
    {
        $rules = [
            'type' => 'required',
            'period' => 'required',
            'total_staff' => 'required',
            'shift_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function assignShift(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('manage.shift')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $id = base64_decode($id);

        try {
            //get Shift
            $shift = Shift::find($id);

            if(is_null($shift)){
                toastr()->error("Record not found");
                return back();
            }

            //check the count of employee to the number of staff needed
            $totalStaffNeeded = $shift->total_staff - $shift->total_staff_assigned;

            //employee needs to be assigned
            $employeeIds = $request->employee_ids;

            if(count($employeeIds) > $totalStaffNeeded){
                toastr()->warning("Error occured. You're trying to overstaff a shift.");
                return back();
            }
            DB::beginTransaction();

            foreach ($employeeIds as $employeeId) {
                
                //check if employee has not been assigned for same date
                $employeeShiftExist = EmployeeShift::where('employee_id', $employeeId)->where('date', $shift->date)->where('status', '!=', 'Cancelled' )->first();
                if($employeeShiftExist){
                    toastr()->warning("One or more employee has a shift already booked for same date.");
                    return back();
                }
                
                $employeeShift = EmployeeShift::create([
                    'shift_id' => $shift->id,
                    'employee_id' => $employeeId,
                    'rules_regulations' => $request->rules_regulations,
                    'date' => $shift->date,
                    'status' => 'Pending',
                ]);

                $shift->update([
                    'total_staff_assigned' => $shift->total_staff_assigned + 1
                ]);

                $currentInstantUser = auth()->user();
                $dataToLog = [
                    'causer_id' => $currentInstantUser->id,
                    'action_id' => $employeeShift->id,
                    'action_type' => "Models\EmployeeShift",
                    'log_name' => "Shift has been assigned to Employee successfully",
                    'action' => 'Create',
                    'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} assign a shift to Employee successfully",
                ];

                ProcessAuditLog::storeAuditLog($dataToLog);
                //send Email to Employee
                Notification::route('mail', $employeeShift->employee->email)->notify(new AssignEmployeeShiftNotification($employeeShift));
                if($request->notify_client){
                    //send email to client
                    Notification::route('mail', $shift->clients->email)->notify(new AssignClientShiftNotification($employeeShift));
                }

            }
            $newshift = Shift::find($id);
            if($shift->total_staff == $shift->total_staff_assigned){
                $newshift->update([
                    'status' => "Assigned",
                ]);
            }

            DB::commit();
            toastr()->success("Shift Assigned successfully.");
            return back();
        
        } catch (\Throwable $error) {
            DB::rollBack();
            toastr()->error($error->getMessage());
            return back();
        }
    }

}
