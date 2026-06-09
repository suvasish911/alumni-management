<?php

namespace App\Http\Controllers;

use App\Models\DonationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationHistoryController extends Controller
{
public function history()
    {
        $histories = DonationHistory::with('project')->latest()->get();
        return view('admin.donations.history', compact('histories'));
    }
}
