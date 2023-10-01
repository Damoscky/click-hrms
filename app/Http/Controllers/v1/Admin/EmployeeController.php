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
use App\Notifications\ReferenceEmailNotification;
use App\Models\EmployeeReference;
use App\Helpers\ProcessAuditLog;
use App\Models\Document;
use App\Models\EmployeeCertification;
use App\Models\EmployeeDisapproval;
use App\Models\EmployeeShift;
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

    public function sendReferenceReminder($id)
    {

        $id = base64_decode($id);

        $user = User::find($id);

        if (is_null($user)) {
            toastr()->warning("Record not found");
            return back();
        }
        
        DB::beginTransaction();

        try {

            //check if reference is two
            $record = EmployeeReference::where('user_id', $user->id)->first();

            //check if reference has been submitted
            if($record->status == 'Submitted'){
                toastr()->warning("Reference has already been submitted");
                return back();
            }

            $verification_code = Str::random(30); 

            $data = [
                'fullname' => $user->first_name.' '.$user->last_name,
                'contact_name' => $record->contact_name,
                'reference_type' => $record->reference_type,
                'email' => $record->email,
                'token' => $verification_code
            ];

            $record->update([
                'token' => $verification_code,
                'status' => 'Pending'
            ]);

            //send email to the referees
            Notification::route('mail', $record->email)->notify(new ReferenceEmailNotification($data));

            DB::commit();

            toastr()->success('Reference Notification sent successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
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

    public function pendingRegistration()
    {
        if(!auth()->user()->hasPermission('view.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $employeeRole = 'employee';
            // $recordSearchParam = $request->searchByDate;

        $totalEmployees = User::whereHas('roles', function ($roleTable) use ($employeeRole) {
            $roleTable->where('slug', $employeeRole);
        })->where('sent_for_approval', false)->orderBy('created_at', 'DESC')->paginate(16);
        $departments = Department::where('is_active', true)->get();
        return view('admin.employee.pending-employees-registration', ['departments' => $departments, 'totalEmployees' => $totalEmployees]);
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

        $shifts = EmployeeShift::where('employee_id', $record->id)->get();
        return view('admin.employee.view-employee', ['employee' => $record, 'shifts' => $shifts]);
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
            'action' => 'Edit',
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
            'action' => 'Edit',
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
                'action' => 'Create',
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

    public function uploadCertification(Request $request)
    {

        $validateRequest = $this->validateCertificate($request);

        if ($validateRequest->fails()) {
            return response()->json([
                'message' => $validateRequest->errors()->first(),
                'error' => true,
                'data' => []
            ]);
            // toastr()->warning($validateRequest->errors()->first());
            // return back();
        }
        DB::beginTransaction();
        $currentInstantUser = User::find($request->viewed_employee_id);

        //check if same type has been uploaded 
        $typeExist = EmployeeCertification::where('document_type', $request->document_type)->where('user_id', $currentInstantUser->id)->first();
        if(!is_null($typeExist)){
            return response()->json([
                'message' => $request->document_type .' has already been uploaded. Please select another document type',
                'error' => true,
                'data' => ''
            ]);
        }
        try {

            $record = EmployeeRecord::where('user_id', $currentInstantUser->id)->first();

            $image = $request->document_file;
            if($image){
                $fileSize = number_format($image->getSize() * 0.000001, 2);
                $fileMime = $image->getMimeType(); 
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'document_' . $record->employee_id . '_'. $request->document_type . '.' . $fileExt;
                $fileUrl = config('app.url') . 'documents/' . $name;
    
                $image->move(public_path('documents'), $fileUrl);
            }else{
                $fileUrl = null;
            }
            

            $certificate = EmployeeCertification::create([
                'user_id' => $currentInstantUser->id,
                'document_type' => $request->document_type,
                'document_extension' => $fileExt,
                'is_admin' => true,
                'file_path' => $fileUrl,
                'size' => $fileSize,
                'document_mime' => $fileMime,
                'issued_date' => $request->issued_date,
                'expiry_date' => $request->expiry_date,
            ]);

            $dataToLog = [
                'causer_id' => $currentInstantUser->id,
                'action_id' => $certificate->id,
                'action_type' => "Models\EmployeeCertification",
                'log_name' => "EmployeeCertification updated successfully",
                'action' => 'Create',
                'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} added a new Certification successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            DB::commit();

            return response()->json([
                'message' => 'Document saved successfully',
                'error' => false,
                'data' => $certificate
            ]);
            // toastr()->success('Document Uploaded successfully');
            // return back();
        } catch (\Throwable $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'error' => true,
                'data' => []
            ]);
            // toastr()->error($error->getMessage());
            // return back();
        }
    }

    public function uploadDocument(Request $request, $id)
    {

        $validateRequest = $this->validateDocument($request);

        if ($validateRequest->fails()) {
            return response()->json([
                'message' => $validateRequest->errors()->first(),
                'error' => true,
                'data' => []
            ]);
            // toastr()->warning($validateRequest->errors()->first());
            // return back();
        }
        DB::beginTransaction();

        try {

            $id = base64_decode($id);
            $currentInstantUser = User::find($id);

            //check if same type has been uploaded 
            $typeExist = Document::where('document_type', $request->document_type)->where('user_id', $currentInstantUser->id)->first();
            if(!is_null($typeExist)){
                return response()->json([
                    'message' => $request->document_type .' has already been uploaded. Please select another document type',
                    'error' => true,
                    'data' => ''
                ]);
            }

            $record = EmployeeRecord::where('user_id', $currentInstantUser->id)->first();

            $image = $request->document_file;
            if($image){
                $fileSize = number_format($image->getSize() * 0.000001, 2);
                $fileMime = $image->getMimeType(); 
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'document_' . $record->employee_id . '_'. $request->document_type . '.' . $fileExt;
                $fileUrl = config('app.url') . 'documents/' . $name;
    
                $image->move(public_path('documents'), $fileUrl);
            }else{
                $fileUrl = null;
            }

            $document = Document::create([
                'user_id' => $currentInstantUser->id,
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'document_extension' => $fileExt,
                'document_extension' => $fileExt,
                'size' => $fileSize,
                'document_mime' => $fileMime,
                'file_path' => $fileUrl,
                'issued_date' => $request->issued_date,
                'expiry_date' => $request->expiry_date,
                'document_id' => $request->document_number,
            ]);

            $dataToLog = [
                'causer_id' => $currentInstantUser->id,
                'action_id' => $document->id,
                'action_type' => "Models\Document",
                'log_name' => "Document updated successfully",
                'action' => 'Create',
                'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} added a new Document successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            DB::commit();

            return response()->json([
                'message' => 'Document saved successfully',
                'error' => false,
                'data' => $document
            ]);
            // toastr()->success('Document Uploaded successfully');
            // return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function validateCertificate($request)
    {
        $rules = [
            'document_file' => 'required',
            'document_type' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validateDocument($request)
    {
        $rules = [
            'document_file' => 'required',
            'document_number' => 'required',
            'document_type' => 'required',
            'issued_date' => 'required',
            'expiry_date' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function resendNotification($id)
    {
        if(!auth()->user()->hasPermission('create.employee')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $id = base64_decode($id);
       
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if(is_null($user)){
                toastr()->error("Record not found");
                return back();
            }

            $verification_code = Str::random(30); //Generate verification code

            DB::table('password_resets')->where('email', $user->email)->delete();

            DB::table('password_resets')->insert(['email' => $user->email, 'token' => $verification_code, 'created_at' => Carbon::now()]);

            $data = [
                'name' => $user->first_name,
                'email' => $user->email,
                'verification_code' => $verification_code,
            ];

            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => $user->id,
                'action_type' => "Models\User",
                'log_name' => "Employee Created successfully",
                'action' => 'Create',
                'description' => "{$user->first_name} {$user->last_name} account created successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            //send notification to user
            Notification::route('mail', $user->email)->notify(new CreateEmployeeNotification($data));

            DB::commit();

            toastr()->success("Email notification sent to employee successfully");
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
