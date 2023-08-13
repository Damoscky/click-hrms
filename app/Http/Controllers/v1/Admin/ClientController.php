<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.client.all-client');
    }

    public function show()
    {
        return view('admin.client.view-client');
    }
}
