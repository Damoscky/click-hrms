<?php

namespace App\Http\Controllers\v1\Employee;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAvailability;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvailabilityController extends Controller
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
        $data = array();

        $availabilities = EmployeeAvailability::where('employee_id', $currentInstantUser->id)->get();
        if(count($availabilities) > 0){
            foreach ($availabilities as $availability) {
                $timestamp = Carbon::parse($availability->date);
                $carbonDate = $timestamp->format('l, F j, Y g:i A');
                
                // Create a new data structure for each availability
                $availabilityData = [
                    'title' => $availability->start_time. ' - '. $availability->end_time,               // Set the title here
                    'start' => $carbonDate,  // Set the start date and time
                    'className' => "bg-green",           // Set the class name here
                ];
            
                // Push the availability data into the $data array
                array_push($data, $availabilityData);
            }
        }
       
        return $data;
    }

    public function store(Request $request)
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

        $availability = EmployeeAvailability::create([
            'employee_id' => $currentInstantUser->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'date' => $request->date,
        ]);

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $availability->id,
            'action_type' => "Models\EmployeeAvailability",
            'log_name' => "New availability updated successfully",
            'action' => 'Create',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} added a new availability successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Availability added successfully.");
        return back();
    }
}
