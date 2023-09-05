<?php

namespace App\Http\Controllers\v1\Client;

use App\Http\Controllers\Controller;
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
        return view('client.dashboard', ['pendingShifts' => $pendingShifts, 'completedShifts' => $completedShifts]);
    }
}
