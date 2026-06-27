<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function generalIndex()
    {
        $events = Event::with('category')->latest()->get();
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $events
        // ]);
        return view('general.events.index', compact('events'));
    }

    public function index()
    {
        $user = Auth::user();

        $participatedEvents = $user->registeredEvents()
            ->where('event_type', '!=', 'fundraiser')
            ->with('category')
            ->latest('event_registrations.created_at')
            ->paginate(10, ['*'], 'participated_page');

        $upcomingEvents = Event::where('event_type', 'ticketed')
            ->whereDoesntHave('attendees', function ($subQ) use ($user) {
                $subQ->where('user_id', $user->id);
            })
            ->where(function ($query) {
                $query->where('event_date', '>=', now())
                    ->orWhereNull('event_date');
            })
            ->with('category')
            ->latest()
            ->paginate(10, ['*'], 'upcoming_page');

        return view('alumni.events.index', compact('upcomingEvents', 'participatedEvents'));
    }

    public function register(Request $request, $id)
    {
        $event = Event::where('event_type', 'ticketed')->findOrFail($id);
        $user = Auth::user();

        if (Carbon::parse($event->event_date)->isPast()) {
        return redirect()->back()->with('error', 'Event date expired!');
        }

        if ($user->registeredEvents()->where('event_id', $id)->exists()) {
            return redirect()->back()->with('error', 'You have already registered for this event!');
        }

        $amountToPay = $event->amount;

        if ($amountToPay > 0) {
            $request->validate([
                'transaction_id' => 'required|string|max:255|unique:event_registrations,transaction_id',
            ], [
                'transaction_id.required' => 'This is a paid event. Please provide a Transaction ID to register.',
                'transaction_id.unique' => 'This Transaction ID has already been used.'
            ]);
            $status = 'pending';
        } else {
            $status = 'free';
        }

        $user->registeredEvents()->attach($event->id, [
            'name' => $user->name,
        
            'phone' => $user->phone ?? 'N/A',
            'email' => $user->email,
            'payment_status' => $status,
            'transaction_id' => $amountToPay > 0 ? $request->transaction_id : null,
            'amount_paid' => $amountToPay,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $message = ($status === 'pending') ? 'Submission successful! Awaiting account officer approval.' : 'Successfully registered for the event!';
        return redirect()->route('alumni.events.index')->with('success', $message);
    }
}