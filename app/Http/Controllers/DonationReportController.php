<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationHistory;

class DonationReportController extends Controller
{
   public function report(Request $request)
{
    $query = DonationHistory::query();
    
    if ($request->filled(['start_date', 'end_date'])) {
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';

        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    $donations = $query->with('project')->latest()->get();
    $totalAmount = $donations->sum('amount'); 

    return view('admin.donations.report', compact('donations', 'totalAmount'));
}
}