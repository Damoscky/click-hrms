<?php

namespace App\Http\Controllers\v1\Employee;

use App\Http\Controllers\Controller;
use App\Models\BankInformation;
use App\Models\EmployeeRecord;
use App\Models\Experience;
use App\Models\NextOfKin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        return view('employee.dashboard');
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

            $image = $request->picture;
            $fileExt = $image->getClientOriginalExtension();
            $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
            $name = 'image_' . $record->employee_id . '.' . $fileExt;
            $fileUrl = config('app.url') . 'profile-pictures/' . $name;

            $image->move(public_path('profile-pictures'), $fileUrl);

            $record->update([
                'date_of_birth' => $request->date_of_birth,
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
                'state' => $request->state,
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

            $record = NextOfKin::create([
                'user_id' => auth()->user()->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'relationship' => $request->relationship,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phoneno' => $request->phoneno,
            ]);

            DB::commit();

            toastr()->success('Next of Kin updated successfully');
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
            'state' => 'required',
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
            'picture' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }
}
