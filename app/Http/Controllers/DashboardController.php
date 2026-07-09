<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $totalUsers = User::where('role', 'alumni')->count();
        $eventsCount = Event::count();
        $departmentsCount = \App\Models\User::whereNotNull('department')
                                                ->distinct('department')
                                                ->count('department');


        $totalGainedRaw = Event::sum('amount');
        $totalGained = $totalGainedRaw > 0 ? number_format($totalGainedRaw) . ' TK' : '45K+';


        $upcoming_events = Event::where('event_date', '>=', now()->toDateString())
                                ->orderBy('event_date', 'asc')
                                ->take(3)
                                ->get();


        $user = $request->user();
        $allInvoices = collect(); 
        $allEvents = Event::latest()->get();   
        $myInvoices = collect();  
        $pending_alumni_count = $user ? User::where('role', 'alumni')->where('status', 'pending')->count() : 0;
        

        if ($user) {
            if ($user->role === 'alumni' && strtolower(trim($user->status)) === 'pending') {
                return view('welcome', compact( 
                    'totalUsers', 'eventsCount', 'departmentsCount', 'totalGained',
                    'allInvoices', 'allEvents', 'myInvoices', 'upcoming_events', 'pending_alumni_count'
                ));
            }
            
            if ($user->role === 'admin' || $user->role === 'alumni') {
                return view('welcome', compact(
                    'totalUsers', 'eventsCount', 'departmentsCount', 'totalGained',
                    'allInvoices', 'allEvents', 'myInvoices', 'upcoming_events', 'pending_alumni_count'
                ));
            }
        }


        return view('welcome', compact(
            'totalUsers', 'eventsCount', 'departmentsCount', 'totalGained',
            'allInvoices', 'allEvents', 'myInvoices', 'upcoming_events', 'pending_alumni_count'
        ));
    }
}