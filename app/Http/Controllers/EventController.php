<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event published!');
    }

    
    public function join(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        
        $request->user()->events()->attach($event->id);

        return redirect()->back()->with('success', 'You have registered for this event!');
    }
}
