<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ProcessAuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoginNotification;
use Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginPage()
    {
        return 124;
    }

    public function login(Request $request)
    {
        $validateRequest = $this->validateRequest($request);

        if($validateRequest->fails()){
            toastr()->error($validateRequest->errors()->first());
            return back();
        }

        $credentials = request(['email', 'password']);

        $token = auth()->attempt($credentials);

        if (!$token) {
            toastr()->error("Incorrect email or password");
            return back();
        }
        // Check if email have been verified
        if (!auth()->user()->is_verified) {
            toastr()->error("Account not verified. Kindly verify your email");
            return back();
        }

        // Check if user has been deactivated
        if (!auth()->user()->is_active) {
            toastr()->error("Your account has been deactivated. Please contact the administrator");
            return back();
        }

        // Check if user has been deactivated
        if (!auth()->user()->can_login) {
            toastr()->error("Your account has been deactivated. Please contact the administrator");
            return back();
        }

        $user = User::find(auth()->user()->id);

        if(is_null($user)){
            toastr()->error("Error occured. Please refresh and try again");
            return back();
        }

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => $user->id,
            'action_type' => "Models\User",
            'log_name' => "User logged in successfully",
            'description' => "{$user->first_name} {$user->last_name} logged in successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);
        Notification::route('mail', $user->email)->notify(new LoginNotification($user));

        toastr()->success("You're logged in successfully!");
        return redirect()->route('admin.dashboard');


    }

    public function forgetPasswordPage()
    {
        return view('pages.forget-password');
    }

    public function validateRequest($request)
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        return $validate;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        $currentUserInstance = auth()->user();

        $dataToLog = [
            'causer_id' => auth()->user()->id,
            'action_id' => auth()->user()->id,
            'action_type' => "Models\User",
            'log_name' => "User logged out successfully",
            'description' => "{$currentUserInstance->lastname} {$currentUserInstance->firstname} Logged out successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);

        Auth::logout();

        toastr()->success("You're logged out successfully!");
        return redirect()->back();
        // return JsonResponser::send(false, 'Successfully logged out', null);
    }
}
