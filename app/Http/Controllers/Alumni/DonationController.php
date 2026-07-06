<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Donation;
use App\Models\DonationProject;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        $eventFundraisers = Event::where('event_type', 'fundraiser')->paginate(3, ['*'], 'events');
        $ongoingProjects = DonationProject::paginate(3, ['*'], 'projects');



        return view('alumni.donations.index', compact('eventFundraisers', 'ongoingProjects'));
    }
    public function history(){
        $myEventDonations = EventRegistration::with('event')
            ->where('user_id', Auth::id())
            ->whereHas('event', function ($query) {
                $query->where('event_type', 'fundraiser');
            })
            ->latest()
            ->get();

        $myProjectDonations = \App\Models\Donation::with('category')
            ->where('user_id', Auth::id())
            ->whereNull('event_id')
            ->latest()
            ->get();
        
        return view('alumni.my_contributions', compact('myEventDonations', 'myProjectDonations'));
    }

    public function storeEventDonation(Request $request, $id)
    {
        $event = Event::where('event_type', 'fundraiser')->findOrFail($id);

        if (Carbon::parse($event->event_date)->isPast()) {
        return redirect()->back()->with('error', 'The event is not active!');
        }

        $request->validate([
            'amount_paid' => 'required|numeric|min:1',
            'transaction_id' => 'required|string|max:100',
        ]);

        EventRegistration::create([
            'user_id' => Auth::id(),
            'event_id' => $id,
            'name' => Auth::user()->name,
            
            'phone' => Auth::user()->phone ?? 'N/A',
            'email' => Auth::user()->email,
            'transaction_id' => $request->input('transaction_id'),
            'amount_paid' => $request->input('amount_paid'),
            // 'amount' => $request->input('amount_paid'),
            'payment_status' => 'approved',
            // 'status' => 'approved',
        ]);

        $event->increment('raised_amount', $request->input('amount_paid'));

        return redirect()->back()->with('success', 'Thank you! Your contribution has been added to the fund instantly.');
    }

    public function storeProjectDonation(Request $request, $id)
    {
        if ($request->has('payment_method')) {
            $method = strtolower($request->payment_method);
            if ($method === 'cash') {
                $request->merge(['payment_method' => 'Cash']);
            } elseif ($method === 'bank') {
                $request->merge(['payment_method' => 'Bank']);
            } elseif ($method === 'mfs') {
                $request->merge(['payment_method' => 'MFS']);
            }
        }

        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donation_amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:Cash,Bank,MFS',
            'transaction_id' => 'required|string|max:255',
        ]);

        $project = \Illuminate\Support\Facades\DB::table('donation_projects')->where('id', $id)->first();

        if ($project) {
            $category = \App\Models\DonationCategory::firstOrCreate(
                ['name' => $project->name]
            );
            $categoryId = $category->id;
        } else {
            $firstCategory = \Illuminate\Support\Facades\DB::table('donations_categories')->first();
            $categoryId = $firstCategory ? $firstCategory->id : null;
        }

        \App\Models\Donation::create([
            'user_id' => Auth::id(),
            'donation_project_id' => $id,
            'donor_name' => $request->donor_name,
            'donation_amount' => $request->donation_amount,
            'donation_category_id' => $categoryId,
            'event_id' => null,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'status' => 'approved',
            'receiver_name' => $request->receiver_name ?? 'Online Automated System',
        ]);

        if ($project && \Illuminate\Support\Facades\Schema::hasColumn('donation_projects', 'raised_amount')) {
            \Illuminate\Support\Facades\DB::table('donation_projects')->where('id', $id)->increment('raised_amount', $request->donation_amount);
        }

        return redirect()->back()->with('success', 'Your donation has been submitted successfully!');
    }
}