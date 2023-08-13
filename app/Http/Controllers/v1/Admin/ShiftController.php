<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return view('admin.shift.all-shift');
    }

    public function pendingShifts()
    {
        return view('admin.shift.pending-shift');
    }

}
