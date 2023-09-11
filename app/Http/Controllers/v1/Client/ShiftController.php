<?php

namespace App\Http\Controllers\v1\Client;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewShiftNotification;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('view.shift')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $clientShifts = Shift::where('client_id', auth()->user()->id)->get();
        return view('client.shift.all-shift', ['clientShifts' => $clientShifts]);
    }

    public function pendingShifts()
    {
        return view('client.shift.pending-shift');
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

        $clientRecord = auth()->user()->clientRecord;

        // Get the arrays of data from the request
        $types = $request->input('type');
        $periods = $request->input('period');
        $totalStaff = $request->input('total_staff');
        $shiftDates = $request->input('shift_date');
        $startTimes = $request->input('start_time');
        $endTimes = $request->input('end_time');
        $bankHoliday = $request->input('bank_holiday');

        // Loop through the data arrays and insert records
        foreach ($types as $key => $type) {

            //check for type and rate

            // Create a new Shift model or use your existing model
            $shift = new Shift();

            // Assign values from the arrays
            $shift->client_id = auth()->user()->id;
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
        $adminRole = ['Workforce Admin Access', 'Admin'];

        $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
            $roleTable->whereIn('name', $adminRole);
        })->pluck('email');

        //send email to Admin
        Notification::route('mail', $superAdmins)->notify(new NewShiftNotification($clientRecord));
        $currentInstantUser = auth()->user();
        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $shift->id,
            'action_type' => "Models\Shift",
            'log_name' => "Shift Created successfully",
            'action' => 'Create',
            'description' => "{$clientRecord->company_name} created a shift successfully",
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
            'description' => "{$currentInstantUser->clientRecord->company_name} updated a shift successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Record updated successfully.");
        return back();

    }

    public function cancelShifts($id)
    {
        $id = base64_decode($id);

        $currentInstantUser = auth()->user();

        $record = Shift::where('id', $id)->where('client_id', $currentInstantUser->id)->first();

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
