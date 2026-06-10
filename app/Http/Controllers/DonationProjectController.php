<?php

namespace App\Http\Controllers;

use App\Models\DonationProject;
use Illuminate\Http\Request;

class DonationProjectController extends Controller
{
    public function index()
    {
        $projects = DonationProject::all();
        return view('admin.projects.index', compact('projects'));
    }
}