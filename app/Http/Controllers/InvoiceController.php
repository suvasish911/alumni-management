<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
   
    public function index(Request $request)
    {
        $user = $request->user();

        if (in_array($user->role, ['account_officer', 'admin'])) {
            
            $invoices = Invoice::with('user')->latest()->paginate(10);
        } else {
            
            $invoices = Invoice::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('invoices.index', compact('invoices'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'alumni_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
        ]);

        Invoice::create([
            'user_id' => $request->alumni_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'status' => 'unpaid',
        ]);

        return redirect()->back()->with('success', 'Invoice generated successfully!');
    }
}
