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
            'category_id' => 'nullable|exists:events_categories,id',
            'name'        => 'required|string|max:255',
            'place'       => 'required|string|max:255',
            'organized_by'=> 'required|string|max:255',
            'event_date'  => 'nullable|date',
        ]);

        if (!empty($validated['event_date'])) {
        $validated['event_date'] = date('Y-m-d H:i:s', strtotime($validated['event_date']));
    }

        Event::create($validated);

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
        //
        $events = Event::findOrFail($id);

        $categories = EventCategory::all();

        return view('admin.events.edit', compact('events','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $events = Event::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'nullable|exists:events_categories,id',
            'name'        => 'required|string|max:255',
            'place'       => 'required|string|max:255',
            'organized_by'=> 'required|string|max:255',
            'event_date'  => 'nullable|date',

        ]);
        
        if (!empty($validated['event_date'])) {
        $validated['event_date'] = date('Y-m-d H:i:s', strtotime($validated['event_date']));
        }
        $events = Event::findOrFail($id);
        $events->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $events = Event::findOrFail($id);

        $events->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }
}