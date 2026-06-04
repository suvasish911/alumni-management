<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AlumniApprovalController extends Controller
{
    
    public function index()
    {
        $pendingAlumni = User::where('role', 'alumni')
                             ->where('status', 'pending')
                             ->latest()
                             ->get();

        return view('panel.pages.approvals', compact('pendingAlumni'));
    }


    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active', 'role' => 'alumni']);

        return redirect()->back()->with('success', 'Alumni account approved successfully!');
    }
}
