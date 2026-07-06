<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    public function generalIndex()
    {
        $events = Event::with('category')->latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $events
        ]);
        // return view('general.events.index', compact('events'));
    }

    public function index()
    {
        $user = Auth::user();

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
            ->paginate(10);

        return view('alumni.events.index', compact('upcomingEvents'));
    }

    public function myEvents()
    {
        $user = Auth::user();

        
        $participatedEvents = $user->registeredEvents()
            ->where('event_type', '!=', 'fundraiser')
            ->with('category')
            ->latest('event_registrations.created_at')
            ->paginate(10);

        return view('alumni.events.my_events', compact('participatedEvents'));
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
        return redirect()->route('alumni.events.my_events')->with('success', $message);
    }

    /**
     * Show Profile Edit Form
     */
    public function profileEdit()
    {
        $user = Auth::user();
        return view('alumni.profile.edit', compact('user'));
    }

    /**
     * Update Profile Information
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            
            'student_id' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:50',
            'batch' => 'nullable|string|max:50',
            'session' => 'nullable|string|max:50',
            
            // Professional Info
            'company' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            
            // Image & Password
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        if ($request->has('student_id')) { $user->student_id = $request->student_id; }
        if ($request->has('department')) { $user->department = $request->department; }
        if ($request->has('batch')) { $user->batch = $request->batch; }
        if ($request->has('session')) { $user->session = $request->session; }
        
        $user->company = $request->company;
        $user->designation = $request->designation;

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $file = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile_image', $filename, 'public');
            $user->profile_image = 'profile_image/' . $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('alumni.profile.edit')->with('success', 'Profile updated successfully!');
    }
}