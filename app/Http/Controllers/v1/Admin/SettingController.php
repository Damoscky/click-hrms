<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission('manage.settings')){

            toastr()->error("Access Denied :(");
            return back();
        }
        $setting = CompanySetting::first();
        return view('admin.setting.company-setting', ['companySetting' => $setting]);
    }

    public function updateCompanySetting(Request $request)
    {
        if(!auth()->user()->hasPermission('manage.settings')){

            toastr()->error("Access Denied :(");
            return back();
        }

        $setting = CompanySetting::first();

        if(is_null($setting)){
            $record = CompanySetting::create([
                'standard_hca' => $request->standard_hca,
                'senior_hca' => $request->senior_hca,
                'currency' => $request->currency,
                'rgn' => $request->rgn,
                'kitchen_assistant' => $request->kitchen_assistant,
                'laundry' => $request->laundry,
                'email' => $request->company_email,
                'phoneno' => $request->contact_number,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'sort_code' => $request->sort_code,
                'bank_name' => $request->bank_name,
                'iban' => $request->iban,
                'bic' => $request->bic,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'city' => $request->city,
                'county' => $request->county,
                'rules_regulations' => $request->rules_regulations 
            ]);
        }else{
            $setting->update([
                'standard_hca' => $request->standard_hca,
                'senior_hca' => $request->senior_hca,
                'currency' => $request->currency,
                'rgn' => $request->rgn,
                'kitchen_assistant' => $request->kitchen_assistant,
                'laundry' => $request->laundry,
                'email' => $request->company_email,
                'phoneno' => $request->contact_number,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'sort_code' => $request->sort_code,
                'bank_name' => $request->bank_name,
                'iban' => $request->iban,
                'bic' => $request->bic,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'city' => $request->city,
                'county' => $request->county,
                'rules_regulations' => $request->rules_regulations 
            ]);
        }

        toastr()->success("Record updated successfully");
        return back();
    }
}
