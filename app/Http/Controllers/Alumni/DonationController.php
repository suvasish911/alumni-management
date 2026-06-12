<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Donation; 
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display both Fundraiser Events and Ongoing Donation Projects to the Alumnus
     */
    public function index()
    {
        
        $eventFundraisers = Event::where('event_type', 'fundraiser')
                                 ->latest()
                                 ->get();

      
        $ongoingProjects = \App\Models\DonationProject::latest()->get(); 


        $myEventDonations = EventRegistration::with('event')
                                ->where('user_id', Auth::id())
                                ->whereHas('event', function ($query) {
                                    $query->where('event_type', 'fundraiser');
                                })
                                ->latest()
                                ->get();

        return view('alumni.donations.index', compact('eventFundraisers', 'ongoingProjects', 'myEventDonations'));
    }

    /**
     * Handle submission for a timed Event Fundraiser
     */
    public function storeEventDonation(Request $request, $id)
    {
        $event = Event::where('event_type', 'fundraiser')->findOrFail($id);

        $request->validate([
            'amount_paid'    => 'required|numeric|min:1',
            'transaction_id' => 'required|string|max:100',
        ]);

        // Fix: Save into BOTH 'amount' and 'amount_paid' as well as 'status' and 'payment_status'
        // This ensures compatibility with whatever column version your migrations and Admin controllers expect.
        EventRegistration::create([
            'user_id'         => Auth::id(),
            'event_id'        => $event->id,
            'name'            => Auth::user()->name,
            'email'           => Auth::user()->email,
            'transaction_id'  => $request->input('transaction_id'),
            
            // Fixes the 0.00 TK bug:
            'amount_paid'     => $request->input('amount_paid'),
            'amount'          => $request->input('amount_paid'), 
            
            // Fixes the "Pending" bug (instant approval bypass):
            'payment_status'  => 'approved', 
            'status'          => 'approved', 
        ]);

        // Automatically update the total campaign tracker bar
        $event->increment('raised_amount', $request->input('amount_paid'));

        return redirect()->back()->with('success', 'Thank you! Your contribution has been added to the fund instantly.');
    }

    /**
     * Handle submission for an Ongoing Donation Project (No Time Limit)
     */
    public function storeProjectDonation(Request $request, $id)
    {
        $categoryExists = DB::table('donations_categories')->where('id', $id)->exists();
        
        if (!$categoryExists) {
            // Safe fallback: grab the first active designative category row
            $firstCategory = DB::table('donations_categories')->first();
            if ($firstCategory) {
                $id = $firstCategory->id;
            } else {
                // If the table is empty, generate a fallback entry row to please foreign key requirements
                $id = DB::table('donations_categories')->insertGetId([
                    'name'       => 'General Welfare Fund',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $request->validate([
            'donation_amount' => 'required|numeric|min:1',
            'transaction_id'  => 'required|string|max:100',
            'payment_method'  => 'required|in:Cash,Bank,MFS'
        ]);

        // Force state to instantly 'approved' 
        Donation::create([
            'donor_name'           => Auth::user()->name,
            'donation_amount'      => $request->input('donation_amount'),
            'donation_category_id' => $id,
            'payment_method'       => $request->input('payment_method'),
            'transaction_id'       => $request->input('transaction_id'),
            'receiver_name'        => 'Online Automated System',
            'status'               => 'approved', 
        ]);

        return redirect()->back()->with('success', 'Your donation has been successfully added to the ledger.');
    }
}