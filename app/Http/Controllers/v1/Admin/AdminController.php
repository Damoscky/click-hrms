<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function dashboard()
    {
        if(auth()->user()->hasPermission('view.dashboard')){
            return view('admin.dashboard');
        }
        toastr()->error("Access Denied :(");
        return back();
            

    }
}
