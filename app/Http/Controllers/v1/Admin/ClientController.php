<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientRecord;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreateClientNotification;
use App\Helpers\ProcessAuditLog;
use PDF, Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ClientController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('view.client')){
            toastr()->error("Access Denied :(");
            return back();
        }

        $clientRole = 'client';
        $totalClients = User::whereHas('roles', function ($roleTable) use ($clientRole) {
            $roleTable->where('slug', $clientRole);
        })->where('is_active', true)->get();
        $totalActiveClients = User::whereHas('roles', function ($roleTable) use ($clientRole) {
            $roleTable->where('slug', $clientRole);
        })->where('is_active', true)->get();
        $totalInactiveClients = User::whereHas('roles', function ($roleTable) use ($clientRole) {
            $roleTable->where('slug', $clientRole);
        })->where('is_active', false)->get();
        $departments = Department::where('is_active', true)->get();
        $data = [
            'totalClients' => $totalClients,
            'totalActiveClients' => $totalActiveClients,
            'totalInactiveClients' => $totalInactiveClients,
            'departments' => $departments
        ];

        return view('admin.client.all-client', ['data' => $data]);
        
    }

    public function show()
    {
        if(!auth()->user()->hasPermission('view.client')){
            toastr()->error("Access Denied :(");
            return back();
        }
        return view('admin.client.view-client');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create.client')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $validateRequest = $this->validateClientRequest($request);

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
            $role = Role::where('slug', 'client')->first();

            if(isset($user) && isset($role)){
                $user->attachRole($role);

                $location = $this->getLocationFromPostcode($request->postcode);
                if(!isset($location)){
                    toastr()->error("Invalid Postcode");
                    return back();
                }
                $fullAddress = $location['formatted_address'];
                $latitude = $location['geometry']['bounds']['northeast']['lat'];
                $longitude = $location['geometry']['bounds']['northeast']['lng'];
                $state = $location['address_components'][3]['short_name'];
                $county =  $location['address_components'][4]['short_name'];
                $country = $location['address_components'][5]['short_name'];

                $rand_no = mt_rand(0000,99999);
                $client_id = 'CLK-'. $rand_no  . '-C' .$request->company_name[0];

                $clientRecord = ClientRecord::create([
                    'company_name' => $request->company_name,
                    'user_id' => $user->id,
                    'address' => $fullAddress,
                    'post_code' => $request->postcode,
                    'city' => $state,
                    'county' => $county,
                    'country' => $country,
                    'phoneno' => $request->phone_number,
                    'client_id' => $client_id,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'location' => $latitude.','.$longitude
                ]);
            }
            $data = [
                'clientRecord' => $clientRecord,
                'user' => $user
            ];

             // Load the watermark view
             $watermark = view('client.pdf.watermark');
             

            $clientContract = PDF::loadView('client.pdf.contract-document', $data)
            ->setOptions(['isPhpEnabled' => true]) // Enable PHP for inline CSS
            ->setOption('header-html', $watermark->render());

            if(isset($clientContract)){
                $fileExt = "pdf";
                $name = 'contract_' . $client_id . '.' . $fileExt;
                $fileUrl = config('app.url') . 'assets/client-document/' . $name;
                Storage::disk('client-document')->put($name, $clientContract->output());
            }else{
                $fileUrl = null;
            }
            return $fileUrl;
            
            $clientRecord->update([
                'contract_document' => $fileUrl
            ]);

            $data = [
                'name' => $request->first_name,
                'email' => $user->email,
                'verification_code' => $verification_code,
            ];

            $currentInstantUser = auth()->user();

            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => $user->id,
                'action_type' => "Models\User",
                'log_name' => "Client Created successfully",
                'action' => 'Create',
                'description' => "{$currentInstantUser->first_name} {$currentInstantUser->last_name} created {$request->company_name} account successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);

            //send notification to client
            Notification::route('mail', $user->email)->notify(new CreateClientNotification($data));

            DB::commit();

            toastr()->success("Record created successfully. Email notification sent to the client");
            return back();

        } catch (\Throwable $error) {
            DB::rollBack();
            toastr()->error($error->getMessage());
            return back();
        }

    }


    public function validateClientRequest($request)
    {
        $rules = [
            'email' => 'required|confirmed|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|unique:users,phoneno',
            'company_name' => 'required',
            'postcode' => 'required',
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
}
