<?php

namespace App\Http\Controllers\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTimesheet;
use Illuminate\Http\Request;
use App\Models\Shift;
class DashboardController extends Controller
{
    
    public function dashboard()
    {
        if (!auth()->user()->is_completed) {
            toastr()->warning("Please complete contract documentation!");
            return redirect()->route('client.complete-registration');
        }
        $pendingShifts = Shift::where('status', 'Pending')->where('client_id', auth()->user()->id)->get();
        $completedShifts = Shift::where('status', 'Completed')->where('client_id', auth()->user()->id)->get();
        $recentTimesheet = EmployeeTimesheet::with('employee', 'shift')->where('client_id', auth()->user()->id)->orderBy('created_at', 'DESC')->take(2)->get();
        return view('client.dashboard', ['pendingShifts' => $pendingShifts, 'completedShifts' => $completedShifts, 'recentTimesheet' => $recentTimesheet]);
    }
}
