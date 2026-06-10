<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function generalIndex() {
        $events = Event::with('category')->latest()->get();
        return view('general.events.index', compact('events'));
    }
 
    public function index() {
        $user = Auth::user();

        $participatedEvents = $user->registeredEvents()
                                   ->with('category')
                                   ->latest('event_registrations.created_at')
                                   ->paginate(10, ['*'], 'participated_page');

        // $participatedIds = $participatedEvents->pluck('id')->toArray();
        
       
        $upcomingEvents = Event::where(function($query) use ($user){
            $query->where(function($q) use ($user) {
            $q->where('event_type', 'ticketed')
              ->whereDoesntHave('attendees', function($subQ) use ($user){
                  $subQ->where('user_id', $user->id);
              });
        })
        ->orWhere(function($q){
            $q->where('event_type', 'fundraiser')
              ;
        });
        })
        ->where(function($query){
            $query->where('event_date', '>=', now())
                  ->orWhereNull('event_date');
        })
        ->with('category')
        ->latest()
        ->paginate(10, ['*'], 'upcoming_page');

        return view('alumni.events.index', compact('upcomingEvents', 'participatedEvents'));
    }

    public function register(Request $request, $id) {
        $events = Event::findOrFail($id); 
        $user = Auth::user();


        if ($events->event_type === 'ticketed' && $user->registeredEvents()->where('event_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You have already registered for this event!');
        }

        if ($events->event_type === 'fundraiser' && $events->raised_amount >= $events->amount) {
        return redirect()->back()->with('error', 'This fundraising campaign has already achieved its goal! Thank you for your support.');
        }

        if ($events->event_type === 'ticketed') {
            $amountToPay = $events->amount;

            if ($amountToPay > 0) {
                $request->validate([
                    'transaction_id' => 'required|string|max:255|unique:event_registrations,transaction_id',
                ], [
                    'transaction_id.required' => 'This is a paid event. Please provide a Transaction ID to register.'
                ]);
                $status = 'pending';
            } else {
                $status = 'free';
            }
        } else {
            // It's a Fundraiser: Require a custom donation amount input field
            $request->validate([
                'amount_paid'    => 'required|numeric|min:1',
                'transaction_id' => 'required|string|max:255|unique:event_registrations,transaction_id',
            ], [
                'amount_paid.required'    => 'Please enter the amount you wish to contribute.',
                'transaction_id.required' => 'Please provide a Transaction ID for your donation.'
            ]);

            $amountToPay = $request->amount_paid;
            $status = 'pending'; // Contributions always require verification
        }

        // 3. Attach data record via your relationship pivot mapping table
        $user->registeredEvents()->attach($events->id, [
            'payment_status' => $status,
            'transaction_id' => $amountToPay > 0 ? $request->transaction_id : null,
            'amount_paid'    => $amountToPay,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $message = ($status === 'pending') ? 'Submission successful! Awaiting account officer approval.' : 'Successfully registered for the event!';

        return redirect()->route('alumni.events.index')->with('success', $message);
    }
}