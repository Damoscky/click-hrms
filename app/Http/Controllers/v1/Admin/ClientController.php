<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasPermission('view.client')){
            return view('admin.client.all-client');
        }
        toastr()->error("Access Denied :(");
        return back();
    }

    public function show()
    {
        if(!auth()->user()->hasPermission('view.client')){
            toastr()->error("Access Denied :(");
            return back();
        }
        return view('admin.client.view-client');
    }
}
