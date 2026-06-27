<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AlumniApprovalController extends Controller
{
    public function index()
    {
        $pendingAlumni = User::where('role', 'alumni')
                             ->where('status', 'pending')
                             ->latest()
                             ->get();

        return view('admin.approvals', compact('pendingAlumni'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active', 'role' => 'alumni']);

        return redirect()->back()->with('success', 'Alumni account approved successfully!');
    }

    public function reject($id) 
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => 'rejected'
        ]);


        return redirect()->back()->with('success', "Account for {$user->name} has been rejected");
    }

    public function paymentIndex() 
    {
        $registrations = DB::table('event_registrations')
                ->join('users', 'event_registrations.user_id', '=', 'users.id')
                ->join('events', 'event_registrations.event_id', '=', 'events.id')
                ->select(
                    'event_registrations.*',
                    'users.name as alumni_name',
                    'users.email as alumni_email',
                    'events.name as event_title',
                    'events.amount as event_fee'
                )
                ->latest('event_registrations.created_at')
                ->paginate(5);

        return view('panel.pages.payment_approvals', compact('registrations'));
    }

    public function verifyPayment($id)
    {
        DB::table('event_registrations')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Transaction verified and registration finalized successfully.');
    }

    public function rejectPayment($id)
    {
        DB::table('event_registrations')
            ->where('id', $id)
            ->update([
                'status' => 'rejected',
                'updated_at' => now()
            ]);

        return redirect()->back()->with('error', 'Payment submission marked as invalid/rejected.');
    }
}