<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationProject;
use Illuminate\Http\Request;

class DonationProjectController extends Controller
{    
    public function index()
    {
        $projects = DonationProject::where('status', 'Active')->get();
        
        return view('admin.donation_projects', compact('projects'));
    }
}
