<?php 

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\DonationProject; 
use App\Models\Donation;           
use App\Models\DonationCategory;   

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
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string', 
            'goal_amount' => 'required|numeric|min:1', 
        ]); 

       
        $category = DonationCategory::firstOrCreate([
            'name' => $request->name
        ]);

       
        $validated['status'] = 'Active'; 

        DonationProject::create($validated); 

        return redirect()->back()->with('success', 'New donation project category created successfully!'); 
    } 

 
    public function projectDonors($id)
    {

        $project = DonationProject::findOrFail($id);

       
        $donors = Donation::where('donation_project_id', $id)
            ->latest()
            ->get();
        
        $totalRaisedDynamic = Donation::where('donation_project_id', $id)
        ->sum('donation_amount');

       
        return view('admin.donations.project_donors', compact('project', 'donors', 'totalRaisedDynamic'));
    }
}