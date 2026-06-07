<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationHistory;

class DonationReportController extends Controller
{
    public function report(Request $request)
    {
        $query = DonationHistory::query();
        
        if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    $donations = $query->with('project')->latest()->get();
    $totalAmount = $donations->sum('amount'); 

    return view('admin.donations.report', compact('donations', 'totalAmount'));
}
}
