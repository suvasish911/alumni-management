<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    public function generalIndex() {
        $events = Event::with('category')->latest()->get();

        return view('general.events.index', compact('events'));
    }
 
    public function index(){
     $user = Auth::user();

        $participatedEvents = $user->registeredEvents()
                                   ->with('category')
                                   ->latest('event_registrations.created_at')
                                   ->paginate(10,['*'],'participated_page');

        $participatedIds = $participatedEvents->pluck('id')->toArray();
        $upcomingEvents = Event::with('category')
                               ->whereNotIn('id', $participatedIds)
                               ->where('event_date', '>=', now())
                               ->orderBy('event_date', 'asc')
                               ->paginate(10,['*'],'upcoming_page');
     return view('alumni.events.index',compact('upcomingEvents','participatedEvents'));
    }

   public function register(Request $request,$id){
    $events = Event::findOrFail($id);
    $user = Auth::user();

    if($user->registeredEvents()->where('event_id',$id)->exists()) {
        return redirect()->back()->with('error','you have already registered for this event!');
    }

    if ($event->amount > 0) {
            $request->validate([
                'transaction_id' => 'required|string|max:255',
            ], [
                'transaction_id.required' => 'This is a paid event. Please provide a Transaction ID to register.'
            ]);
            $status = 'pending';
    } else {
            $status = 'free';
    }

    $user->registeredEvents()->attach($events->id, [
        'payment_status' => $status,
        'transaction_id' =>$events->amount > 0 ? $request->transaction_id : null,
        'amount_paid'    => $events->amount,
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);

    $message = ($status === 'pending') ? 'Registration Submitted! Awaiting account officer approaval.' : 'Successfully registered for the event!';

    return redirect()->route('alumni.events.index')->with('success',$message);
   }
}
