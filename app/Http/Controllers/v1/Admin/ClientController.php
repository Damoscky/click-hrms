<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

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
}
