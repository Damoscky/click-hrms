<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ProcessAuditLog;
use App\Models\EmployeeAvailability;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index()
    {
        $totalShifts = Shift::get();
        return view('admin.shift.all-shift', ['totalShifts' => $totalShifts]);
    }

    public function pendingShifts()
    {
        $companySettings = CompanySetting::first();
        $totalShifts = Shift::where('status', 'Pending')->get();
        // return $employeeAvailability = \App\Models\EmployeeAvailability::with('employee')->whereDate('date', \Carbon\Carbon::parse($shift->data))->get();
        return view('admin.shift.pending-shift', ['totalShifts' => $totalShifts, 'companySettings' => $companySettings]);
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

}
