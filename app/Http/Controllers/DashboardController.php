<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Event;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
{
    $user = $request->user();
    
    if($user->role === 'alumni' && strtolower(trim($user->status)) === 'pending') {
        
        $totalUsers = User::count();
        $allInvoices = collect();
        $allEvents = collect();
        $myInvoices = collect();
        $upcoming_events = collect();
        $pending_alumni_count = User::where('role','LIKE','%alumni%')->where('status','LIKE','%pending%')->count();

        return view('panel.pages.dashboard', compact( 
            'totalUsers',
            'allInvoices',
            'allEvents',
            'myInvoices',
            'upcoming_events',
            'pending_alumni_count'
        ));
    }
    
    $totalUsers = User::count();
    $allInvoices = collect(); 
    $allEvents = collect();   
    $myInvoices = collect();  
    $upcoming_events = collect(); 
    $pending_alumni_count = User::where('role','LIKE','%alumni%')->where('status','LIKE','%pending%')->count();
    
    if ($user->role === 'admin') {
        $totalUsers = User::count();
    } 
    
    elseif ($user->role === 'account officer') {
        $allInvoices = Invoice::latest()->get();
    } 
    
    elseif ($user->role === 'alumni') {
        $upcoming_events = Event::get(); 
        $myInvoices = Invoice::where('user_id', $user->id)->get();
    }

    
    return view('panel.pages.dashboard', compact(
        'totalUsers', 
        'allInvoices', 
        'allEvents', 
        'myInvoices',
        'upcoming_events',
        'pending_alumni_count'
    ));
}
}
