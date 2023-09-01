<?php

namespace App\Http\Controllers\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Helpers\ProcessAuditLog;
use App\Notifications\SentForApprovallNotification;
use App\Notifications\ClientNegotiateNotification;
use App\Notifications\AdminNegotiateNotification;
use App\Models\User;
use GuzzleHttp\Client;

class ProfileController extends Controller
{
    public function completeRegistration()
    {
        return view('client.complete-registration');
    }

    public function updateBasicRecord(Request $request)
    {
        $validateRequest = $this->validateBasicRecord($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        try {
            $record = ClientRecord::where('client_id', $request->client_id)->where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                toastr()->error('Error occured. Please refresh and try again');
                return back();
            }

            DB::beginTransaction();

            if(isset($request->logo)){
                $image = $request->logo;
                $fileExt = $image->getClientOriginalExtension();
                $uniqueId = bin2hex(openssl_random_pseudo_bytes(4));
                $name = 'image_' . $record->client_id . '.' . $fileExt;
                $fileUrl = config('app.url') . 'client/' . $name;

                $image->move(public_path('client'), $fileUrl);
            }else{
                $fileUrl = $record->image;
            }

            $currentInstantUser = auth()->user();

            $record->update([
                'company_name' => $request->company_name,
                'image' => $fileUrl,
            ]);

            $currentInstantUser->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => $record->id,
                'action_type' => "Models\ClientRecord",
                'log_name' => "Client record Updated successfully",
                'action' => 'Update',
                'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} updated {$record->company_name} account successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            DB::commit();

            toastr()->success('Record updated successfully');
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
            $record = ClientRecord::where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                toastr()->error('Error occured. Please refresh and try again');
                return back();
            }

            $location = $this->getLocationFromPostcode($request->post_code);

            $latitude = $location['geometry']['bounds']['northeast']['lat'];
            $longitude = $location['geometry']['bounds']['northeast']['lng'];

            DB::beginTransaction();

            $currentInstantUser = auth()->user();

            $record->update([
                'address' => $request->address,
                'post_code' => $request->post_code,
                'city' => $request->city,
                'county' => $request->county,
                'country' => $request->country,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'location' => $latitude.','.$longitude
            ]);

            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => $record->id,
                'action_type' => "Models\ClientRecord",
                'log_name' => "Client Address Updated successfully",
                'action' => 'Update',
                'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} updated {$record->company_name} address information successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            DB::commit();

            toastr()->success('Record updated successfully');
            return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function validateBasicRecord($request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'logo' => 'required',
            'company_name' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function validateAddress($request)
    {
        $rules = [
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'country' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    public function getLocationFromPostcode($postcode)
    {
        $apiKey = 'AIzaSyApcI-eCy2vhDU9Fx4GmhKsysL8xoZ69oU';

        $client = new Client();
        $response = $client->get("https://maps.googleapis.com/maps/api/geocode/json", [
            'query' => [
                'address' => $postcode,
                'key' => $apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['results'][0])) {
            return $location = $data['results'][0];
            return response()->json(['location' => $location]);
        } else {
            return response()->json(['error' => 'Location not found'], 404);
        }
    }

    public function negotiateContract(Request $request)
    {
        $validateRequest = $this->validateRateRequest($request);

        if ($validateRequest->fails()) {
            toastr()->warning($validateRequest->errors()->first());
            return back();
        }

        try {
            $currentInstantUser = auth()->user();

            $record = ClientRecord::where('user_id', auth()->user()->id)->first();

            if (is_null($record)) {
                toastr()->error('Error occured. Please refresh and try again');
                return back();
            }

            $record->update([
                'standard_hca' => $request->negotiating_standard_hca,
                'senior_hca' => $request->negotiating_senior_hca,
                'rgn' => $request->negotiating_rgn,
                'kitchen_assistant' => $request->negotiating_kitchen_assistant,
                'laundry' => $request->negotiating_laundry,
                'status' => 'Review'
            ]);

            $currentInstantUser->update([
                'sent_for_approval' => true,
                'status' => 'Review',
            ]);

            $adminRole = 'Super Admin';

            $superAdmins = User::whereHas('roles', function ($roleTable) use ($adminRole) {
                $roleTable->where('name', $adminRole);
            })->pluck('email');

             //send email to Admin
             Notification::route('mail', $superAdmins)->notify(new AdminNegotiateNotification($record));
             Notification::route('mail', $currentInstantUser->email)->notify(new ClientNegotiateNotification($record));

             toastr()->success('Record sent for review successfully');
             return back();
        } catch (\Throwable $error) {
            toastr()->error($error->getMessage());
            return back();
        }
    }

    public function validateRateRequest($request)
    {
        $rules = [
            'negotiating_standard_hca' => 'required',
            'negotiating_senior_hca' => 'required',
            'negotiating_rgn' => 'required',
            'negotiating_kitchen_assistant' => 'required',
            'negotiating_laundry' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }
}
