<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Event;                 
use App\Models\EventCategory;         
use Illuminate\Http\Request;

class EventController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('category')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = EventCategory::all();
        return view('admin.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'nullable|string|max:255',
            'name'        => 'required|string|max:255',
            'place'       => 'required|string|max:255',
            'organized_by'=> 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'event_type'  => 'required|in:ticketed,fundraiser',
            'event_date'  => 'nullable|date',
        ]);
        $categoryId = null;
        if (!empty($request->category_name)) {
            $category = EventCategory::firstOrCreate([
                'name' => trim($request->category_name)
            ]);
            $categoryId = $category->id;
        }

        if (!empty($validated['event_date'])) {
            $validated['event_date'] = date('Y-m-d H:i:s', strtotime($validated['event_date']));
        }

        $eventData = array_merge($validated, [
            'category_id' => $categoryId,
            'raised_amount' => 0.00
        ]);

        unset($eventData['category_name']);
        Event::create($eventData);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $events = Event::findOrFail($id);
        $categories = EventCategory::all();
        return view('admin.events.edit', compact('events','categories'));
    }

  
    public function update(Request $request, string $id)
    {
        $events = Event::findOrFail($id);

        $validated = $request->validate([
            'category_name' => 'nullable|string|max:255',
            'name'        => 'required|string|max:255',
            'place'       => 'required|string|max:255',
            'organized_by'=> 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'event_type'  => 'required|in:ticketed,fundraiser',
            'event_date'  => 'nullable|date',
        ]);
        $categoryId = null;
        if (!empty($request->category_name)) {
            $category = EventCategory::firstOrCreate([
                'name' => trim($request->category_name)
            ]);
            $categoryId = $category->id;
        }

        if (!empty($validated['event_date'])) {
            $validated['event_date'] = date('Y-m-d H:i:s', strtotime($validated['event_date']));
        }

        $eventData = array_merge($validated, ['category_id' => $categoryId]);
        unset($eventData['category_name']);

        $events->update($eventData);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }


    public function destroy(string $id)
    {
        $events = Event::findOrFail($id);
        $events->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }

    public function donorlist(string $id)
    {
        $events = Event::with(['category'])->findOrFail($id);
        $registrations = \App\Models\EventRegistration::where('event_id', $id)->latest()->get();

        return view('admin.events.donors', compact('events', 'registrations'));
    }

    public function approveDonor(string $id)
    {
        $registration = \App\Models\EventRegistration::findOrFail($id);
        
       
        $registration->update([
            'payment_status' => 'approved'
        ]);

       
        $event = Event::find($registration->event_id);
        if ($event && $event->event_type === 'fundraiser') {
            if ($registration->amount_paid > 0) {
                $event->increment('raised_amount', $registration->amount_paid);
            }
        }

        
        return redirect()->back()->with('success', 'Transaction approved and confirmed successfully!');
    }
}