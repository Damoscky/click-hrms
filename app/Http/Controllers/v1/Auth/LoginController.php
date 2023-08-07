<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage()
    {
        return 124;
    }

    public function forgetPasswordPage()
    {
        return view('pages.forget-password');
    }
}
