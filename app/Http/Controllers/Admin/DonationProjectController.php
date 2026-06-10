<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationProject;
use Illuminate\Http\Request;

class DonationProjectController extends Controller
{    
    public function index()
    {
        $projects = DonationProject::where('status', 'Active')->latest()->get();
        
        return view('admin.donation_projects', compact('projects'));
    }
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'goal_amount' => 'required|numeric|min:1',
        ]); 
        DonationProject::create($validated);

        return redirect()->back()->with('success', 'New donation project category created successfully!');
    }
}
