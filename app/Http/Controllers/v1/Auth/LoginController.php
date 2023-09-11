<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ProcessAuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoginNotification;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\Input;
use Auth, Hash;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        // if (!auth()->user()->is_active) {
        //     toastr()->error("Your account has been deactivated. Please contact the administrator");
        //     return back();
        // }

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
            'action' => 'updated',
            'description' => "{$user->first_name} {$user->last_name} logged in successfully",
        ];

        ProcessAuditLog::storeAuditLog($dataToLog);
        // Notification::route('mail', $user->email)->notify(new LoginNotification($user));

        toastr()->success("You're logged in successfully!");
        
        if (auth()->user()->roles[0]->slug == "employee") {
            if(!auth()->user()->is_completed || !auth()->user()->is_verified){
                toastr()->success("Your account is pending verification. Please complete your registration.");
                return redirect()->route('employee.complete-registration');
            }
            return redirect()->route('employee.dashboard');
        }

        if (auth()->user()->roles[0]->slug == "client") {
            if(!auth()->user()->is_completed || !auth()->user()->is_verified){
                // toastr()->success("Your account is pending verification. Please complete your registration.");
                return redirect()->route('client.complete-registration');
            }
            return redirect()->route('client.dashboard');
        }
        
        // if (auth()->user()->roles[0]->slug == "superadmin") {
              
            return redirect()->route('admin.dashboard');
        // }
        


    }

    public function forgetPasswordPage()
    {
        return view('auth.forget-password');
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->only("email"), $rules);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return back();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toastr()->error("Email address not found");
            return back();
        }

        try {
            DB::beginTransaction();
            $email = $request->email;

            $verification_code = Str::random(30); //Generate verification code

            $otpCode = random_int(10000, 99999); //generate random num

            DB::table('password_resets')->where('email', $email)->delete();

            DB::table('password_resets')->insert(['email' => $email, 'token' => $verification_code, 'created_at' => Carbon::now()]);

            $data = [
                'name' => $user->first_name,
                'email' => $email,
                'verification_code' => $verification_code,
            ];

            Notification::route('mail', $user->email)->notify(new PasswordResetNotification($data));

            DB::commit();

            toastr()->success("A reset email has been sent! Please check your email.");
            return back();

        } catch (\Exception $error) {
            toastr()->error($error->getMessage());
            return back();
        }
       
    }


    public function createPasswordPage(Request $request, $token)
    {
        $email = $request->email;
        $validateRecord = DB::table('password_resets')->where('email', $email)->where('token', $token)->first();

        if(is_null($validateRecord) || !$token){
            toastr()->error("Invalid token!");
            return redirect()->route('index');
        }
        return view('auth.create-password', ['data' => $validateRecord]);
    }

    public function createPassword(Request $request)
    {
        $rules = [
            'password' =>  [
                    'required',
                    'confirmed',
                    'string',
                    'min:8',             // must be at least 8 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                
            // 'password' => 'required|min:8|confirmed',
            "email" => "required|email",
            "token" => "required"
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return back();
        }

        $token = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$token) {
            toastr()->error("Invalid token!");
            return back();
        }

        $password = $request->password;
        $userdata = User::where('email', $request->email)->first();
        
        $hashedPasword = $userdata->password;
        // check if new password is not the same with old password
        if (Hash::check($password, $hashedPasword)) {
            toastr()->error("New password cannot be the same as old password");
            return back();
            
        }
            
        $updatePassword = $userdata->update([
            'password' => Hash::make($password),
            'can_login' => true,
            'is_verified' => true,
        ]);

        DB::table('password_resets')->where('token', $request->token)->delete();
        if (!$updatePassword) {
            toastr()->error("Error occured! Please refresh and tre again");
            return back();
            
        } else {
            $data = [
                'email' => $userdata->email,
                'name' => $userdata->first_name,
                'subject' => "Password Updated Successfully.",
            ];

            // Mail::to($request->email)->send(new UpdatePasswordEmail($data));
            toastr()->success("Password Updated! Please login with your new password");
            return redirect()->route('index');
        }
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
        if(isset($currentUserInstance)){
            $dataToLog = [
                'causer_id' => auth()->user()->id,
                'action_id' => auth()->user()->id,
                'action_type' => "Models\User",
                'log_name' => "User logged out successfully",
                'action' => 'Update',
                'description' => "{$currentUserInstance->lastname} {$currentUserInstance->firstname} Logged out successfully",
            ];
    
            ProcessAuditLog::storeAuditLog($dataToLog);
        }

        Auth::logout();

        toastr()->success("You're logged out successfully!");
        return redirect()->back();
        // return JsonResponser::send(false, 'Successfully logged out', null);
    }
}
