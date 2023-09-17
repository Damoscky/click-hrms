<?php

namespace App\Http\Controllers\v1\Employee;

use App\Http\Controllers\Controller;
use App\Models\BankInformation;
use App\Models\Document;
use App\Models\EmployeeCertification;
use App\Models\EmployeeRecord;
use App\Models\EmployeeReference;
use App\Models\Experience;
use App\Models\NextOfKin;
use App\Models\EmployeeShift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReferenceEmailNotification;
use App\Helpers\ProcessAuditLog;
use App\Notifications\SentForApprovallNotification;
use App\Notifications\EmployeeSentForApprovallNotification;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function dashboard()
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

        $upcomingShifts = EmployeeShift::where('date', '>=', Carbon::today())->where('status', '!=', 'Cancelled')->where('employee_id', $currentInstantUser->id)->orderBy('created_at', 'DESC')->take(5)->get();
        $pendingShifts = EmployeeShift::where('date', '>=', Carbon::today())->where('status', 'Pending')->where('employee_id', $currentInstantUser->id)->orderBy('created_at', 'DESC')->get();
        $completedShifts = EmployeeShift::where('status', 'Completed')->where('employee_id', $currentInstantUser->id)->orderBy('created_at', 'DESC')->get();
        $totalShifts = EmployeeShift::where('employee_id', $currentInstantUser->id)->orderBy('created_at', 'DESC')->get();
        return view('employee.dashboard', ['totalShifts' => $totalShifts, 'upcomingShifts' => $upcomingShifts, 'pendingShifts' => $pendingShifts, 'completedShifts' => $completedShifts]);
    }

    public function completeRegistration()
    {
        return view('employee.complete-registration');
    }

    public function updatePersonalRecord(Request $request)
    {
        
        $validateRequest = $this->validatePersonalRecord($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        try {
            $record = EmployeeRecord::where('employee_id', $request->employee_id)->where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                toastr()->error('Error occured. Please refresh and try again');
                return back();
            }

            DB::beginTransaction();

            if(isset($request->picture)){
                $image = $request->picture;
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'image_' . $record->employee_id . '.' . $fileExt;
                $fileUrl = config('app.url') . 'profile-pictures/' . $name;

                $image->move(public_path('profile-pictures'), $fileUrl);
            }else{
                $fileUrl = $record->image;
            }

            $record->update([
                'date_of_birth' => $request->date_of_birth,
                'national_insurance' => $request->national_insurance,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'marital_status' => $request->marital_status,
                'image' => $fileUrl,
            ]);

            DB::commit();

            toastr()->success('Personal Information updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function updateAddress(Request $request)
    {
        $validateRequest = $this->validateAddress($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        try {
            $record = EmployeeRecord::where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                toastr()->error('Error occured. Please refresh and try again');
                return back();
            }

            DB::beginTransaction();

            $record->update([
                'country' => $request->country,
                'city' => $request->city,
                'post_code' => $request->post_code,
                'county' => $request->county,
                'address' => $request->address,
                'state' => $request->city,
            ]);

            DB::commit();

            toastr()->success('Address Information updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function updateBankDetails(Request $request)
    {
        $validateRequest = $this->validateBankDetails($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        DB::beginTransaction();

        try {
            $record = BankInformation::where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                $newRecord = BankInformation::create([
                    'user_id' => auth()->user()->id,
                    'account_name' => $request->account_name,
                    'account_number' => $request->account_number,
                    'sort_code' => $request->sort_code,
                    'bank_name' => $request->bank_name
                ]);
            }else{
                $record->update([
                    'account_name' => $request->account_name,
                    'account_number' => $request->account_number,
                    'sort_code' => $request->sort_code,
                    'bank_name' => $request->bank_name
                ]);
            }

            DB::commit();

            toastr()->success('Bank Details updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        } 
    }

    public function updateNextOfKin(Request $request)
    {
        $validateRequest = $this->validateNextOfKin($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        DB::beginTransaction();

        try {
            $record = NextOfKin::where('user_id', auth()->user()->id)->first();

            if(is_null($record)){
                $newRecord = NextOfKin::create([
                    'user_id' => auth()->user()->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'relationship' => $request->relationship,
                    'email' => $request->email,
                    'date_of_birth' => $request->date_of_birth,
                    'phoneno' => $request->phoneno,
                ]);
            }else{
                $record->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'relationship' => $request->relationship,
                    'email' => $request->email,
                    'date_of_birth' => $request->date_of_birth,
                    'phoneno' => $request->phoneno,
                ]);
            }

            DB::commit();

            toastr()->success('Next of Kin updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function updateEmployeeReference(Request $request)
    {
        $validateRequest = $this->validateReference($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }
        DB::beginTransaction();

        try {

            //check if reference is two
            $record = EmployeeReference::where('user_id', auth()->user()->id)->count();

            if($record > 1){
                toastr()->warning("Maximum of 2 reference is required");
                return back();
            }
            $verification_code = Str::random(30); 

            $record = EmployeeReference::create([
                'user_id' => auth()->user()->id,
                'contact_name' => $request->contact_name,
                'company_name' => $request->company_name,
                'phoneno' => $request->phoneno,
                'start_date' => $request->start_date,
                'reference_type' => $request->reference_type,
                'end_date' => $request->end_date,
                'token' => $verification_code,
                'status' => 'Pending',
                'email' => $request->email,
            ]);

            $data = [
                'contact_name' => $request->contact_name,
                'reference_type' => $request->reference_type,
                'email' => $request->email,
                'token' => $verification_code
            ];

            //send email to the referees
            Notification::route('mail', $request->email)->notify(new ReferenceEmailNotification($data));

            DB::commit();

            toastr()->success('Reference updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function updateExperience(Request $request)
    {
        $validateRequest = $this->validateExperience($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }
        DB::beginTransaction();

        try {

            $record = Experience::create([
                'user_id' => auth()->user()->id,
                'employment_type' => $request->employment_type,
                'location' => $request->location,
                'job_title' => $request->job_title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'company_name' => $request->company_name,
            ]);

            DB::commit();

            toastr()->success('Job Experience updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function uploadDocument(Request $request)
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

            $currentInstantUser = auth()->user();

            //check if same type has been uploaded 
            $typeExist = Document::where('document_type', $request->document_type)->where('user_id', $currentInstantUser->id)->first();
            if(!is_null($typeExist)){
                return response()->json([
                    'message' => $request->document_type .' has already been uploaded. Please select another document type',
                    'error' => true,
                    'data' => ''
                ]);
            }

            $record = EmployeeRecord::where('user_id', auth()->user()->id)->first();

            $image = $request->document_file;
            if($image){
                $fileSize = number_format($image->getSize() * 0.000001, 2);
                $fileMime = $image->getMimeType(); 
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'image_' . $record->employee_id . '_'. $request->document_type . '.' . $fileExt;
                $fileUrl = config('app.url') . 'documents/' . $name;
    
                $image->move(public_path('documents'), $fileUrl);
            }else{
                $fileUrl = null;
            }

            $document = Document::create([
                'user_id' => auth()->user()->id,
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
                'causer_id' => auth()->user()->id,
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
        $currentInstantUser = auth()->user();

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

            $record = EmployeeRecord::where('user_id', auth()->user()->id)->first();

            $image = $request->document_file;
            if($image){
                $fileSize = number_format($image->getSize() * 0.000001, 2);
                $fileMime = $image->getMimeType(); 
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'image_' . $record->employee_id . '_'. $request->document_type . '.' . $fileExt;
                $fileUrl = config('app.url') . 'documents/' . $name;
    
                $image->move(public_path('documents'), $fileUrl);
            }else{
                $fileUrl = null;
            }
            

            $certificate = EmployeeCertification::create([
                'user_id' => auth()->user()->id,
                'document_type' => $request->document_type,
                'document_extension' => $fileExt,
                'size' => '',
                'file_path' => $fileUrl,
                'size' => $fileSize,
                'document_mime' => $fileMime,
                'issued_date' => $request->issued_date,
                'expiry_date' => $request->expiry_date,
            ]);

            $dataToLog = [
                'causer_id' => auth()->user()->id,
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

    public function validateExperience($request)
    {
        $rules = [
            'employment_type' => 'required',
            'location' => 'required',
            'job_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'company_name' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validateReference($request)
    {
        $rules = [
            'contact_name' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'start_date' => 'required',
            'reference_type' => 'required',
            'end_date' => 'required',
            'phoneno' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }


    public function deleteNextOfKin($id)
    {
        $id = base64_decode($id);
        $record = NextOfKin::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(is_null($record)){
            toastr()->warning('Record not found');
            return back();
        }

        $record->delete();

        toastr()->success('Record deleted successfully!');
        return back();
    }

    public function deleteDocument($id)
    {
        $id = base64_decode($id);
        $record = Document::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(is_null($record)){
            toastr()->warning('Record not found');
            return back();
        }

        $record->delete();

        toastr()->success('Record deleted successfully!');
        return back();
    }

    public function deleteCertificate($id)
    {
        $id = base64_decode($id);
        $record = EmployeeCertification::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(is_null($record)){
            toastr()->warning('Record not found');
            return back();
        }
        $currentInstantUser = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $record->id,
            'action_type' => "Models\EmployeeCertification",
            'log_name' => "EmployeeCertification deleted successfully",
            'action' => 'Delete',
            'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} delete a Certificate successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        $record->delete();

        toastr()->success('Record deleted successfully!');
        return back();
    }

    public function sendForApproval()
    {
        try {
            $record = User::find(auth()->user()->id);

            //check if they upload two reference 
            if(count($record->document) < 2){
                toastr()->error('You need to upload at least two reference');
                return back();
            }

            $record->update([
                'sent_for_approval' => true,
                'status' => 'Review',
            ]);

            $adminRole = 'Super Admin Access';

            $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
                $roleTable->where('name', $adminRole);
            })->pluck('email');

             //send email to Admin
             Notification::route('mail', $superAdmins)->notify(new SentForApprovallNotification($record));
             Notification::route('mail', $record->email)->notify(new EmployeeSentForApprovallNotification($record));

            toastr()->success('Application sent for approval successfully!');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Error occured!');
            return back();
        }
    }

    public function deleteExperience($id)
    {
        $id = base64_decode($id);
        $record = Experience::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if(is_null($record)){
            toastr()->warning('Record not found');
            return back();
        }

        $record->delete();

        toastr()->success('Record deleted successfully!');
        return back();
    }

    public function validateNextOfKin($request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'relationship' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validateBankDetails($request)
    {
        $rules = [
            'bank_name' => 'required',
            'sort_code' => 'required',
            'account_name' => 'required',
            'account_number' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validateAddress($request)
    {
        $rules = [
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'post_code' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validatePersonalRecord($request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'religion' => 'required',
            'date_of_birth' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            // 'picture' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function referenceForm(Request $request, $token)
    {
        $email = $request->email;
        $validateRecord = EmployeeReference::where('email', $email)->where('token', $token)->where('status', 'Pending')->first();

        if(is_null($validateRecord) || !$token){
            toastr()->error("Invalid token!");
            return redirect()->route('index');
        }

        return view('employee.reference-form', ['data' => $validateRecord]);
    }
}
