<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event; 
use App\Models\DonationProject; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $user = Auth::user();

        $results = [
            'events' => collect(),
            'donations' => collect(),
            'users' => collect(),
        ];

        if (empty($query)) {
            return view('panel.search_results', compact('results', 'query'));
        }

        $today = Carbon::today()->toDateString();

        $results['events'] = Event::where(function($q) use ($query) {
                                        $q->where('name', 'LIKE', "%{$query}%")
                                          ->orWhere('place', 'LIKE', "%{$query}%")
                                          ->orWhere('organized_by', 'LIKE', "%{$query}%");
                                    })
                                    ->whereDate('event_date', '>=', $today) 
                                    ->get();

        $results['donations'] = DonationProject::where('name', 'LIKE', "%{$query}%")
                                                ->orWhere('description', 'LIKE', "%{$query}%")
                                                ->get();

        if ($user && $user->role === 'admin') {
            $results['users'] = User::where('name', 'LIKE', "%{$query}%")
                                    ->orWhere('email', 'LIKE', "%{$query}%")
                                    ->orWhere('student_id', 'LIKE', "%{$query}%")
                                    ->get();
        }

        return view('panel.search_results', compact('results', 'query'));
    }
}