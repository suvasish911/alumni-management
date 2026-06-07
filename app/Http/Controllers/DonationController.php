<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationCategory;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('category')->latest()->get();
        return view('admin.donations.index', compact('donations'));
    }
    public function create()
    {
        $categories = DonationCategory::all(); 
        return view('admin.donations.create', compact('categories'));
    }
    public function store(Request $request)
{
    $request->validate([
        'donor_name' => 'required|string|max:255',
        'donation_amount' => 'required|numeric|min:1',
        
        'donation_category_id' => 'nullable|exists:donations_categories,id',
        
        'payment_method' => 'required|in:Cash,Bank,MFS',
        'receiver_name' => 'required|string|max:255',
    ]);

    Donation::create($request->all());

    return redirect()->route('admin.donations.index')->with('success', 'Donation added successfully!');
}

public function edit($id)
{
     $donation = Donation::findOrFail($id);
    $categories = DonationCategory::all(); 

    return view('admin.donations.edit', compact('donation', 'categories'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'donor_name' => 'required|string|max:255',
        'donation_amount' => 'required|numeric|min:1',
        'donation_category_id' => 'nullable|exists:donations_categories,id',
        'payment_method' => 'required|in:Cash,Bank,MFS',
        'receiver_name' => 'required|string|max:255',
    ]);

    $donation = Donation::findOrFail($id);
    $donation->update($request->all());

    return redirect()->route('admin.donations.index')->with('success', 'Donation updated successfully!');
}
public function destroy($id)
{
    $donation = Donation::findOrFail($id);
    $donation->delete();

    return redirect()->route('admin.donations.index')->with('success', 'Donation deleted successfully!');
} 
}