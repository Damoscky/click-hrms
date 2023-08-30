<?php

namespace App\Http\Controllers\v1\Admin;

use App\Helpers\ProcessAuditLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\EmployeeRecord;

class DepartmentController extends Controller
{

    public function index()
    {
        if (!auth()->user()->hasPermission('view.department')) {

            toastr()->error("Access Denied :(");
            return back();
        }

        $activeDepartments = Department::where('is_active', true)->count();
        $inactiveDepartments = Department::where('is_active', false)->count();
        $departments = Department::orderBy('name', 'DESC')->get();

        return view('admin.department.all-departments', ['departments' => $departments, 'activeDepartments' => $activeDepartments, 'inactiveDepartments' => $inactiveDepartments]);
    }


    public function create(Request $request)
    {
        if (!auth()->user()->hasPermission('create.department')) {

            toastr()->error("Access Denied :(");
            return back();
        }

        //check if record already exist
        $recordExist = Department::where('name', $request->department_name)->first();

        if (!is_null($recordExist)) {
            toastr()->error("Name already exist!");
            return back();
        }
        $record = Department::create([
            'name' => $request->department_name
        ]);

        $userInstance = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\Department",
            'log_name' => "Department created successfully",
            'description' => "{$userInstance->first_name} {$userInstance->last_name} created {$record->name} department successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        toastr()->success("Department created successfully");
        return back();
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermission('delete.department')) {

            toastr()->error("Access Denied :(");
            return back();
        }
        $id = base64_decode($id);

        $record = Department::find($id);

        if (is_null($record)) {
            toastr()->error("Record not found");
            return back();
        }

        //check if department is connected to employee
        $employee = EmployeeRecord::where('department_id', $id)->get();
        if (count($employee) > 0) {
            toastr()->warning("Department could not be deleted because it's attached to an Employee!");
            return back();
        }

        $userInstance = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\Department",
            'log_name' => "Department deleted successfully",
            'description' => "{$userInstance->first_name} {$userInstance->last_name} deleted {$record->name} department successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        $record->delete();
        toastr()->success("Record deleted successfully");
        return back();
    }
}
