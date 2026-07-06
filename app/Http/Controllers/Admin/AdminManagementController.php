<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(1);
        return view('admin.manage_admins', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', 
            'status' => 'approved', 
            'profile_image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'New administrator account registered successfully!');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'You cannot remove yourself!');
        }

        $user = User::findOrFail($id);
        
        $user->update(['role' => 'user']); 

        //To delete an admin permenently from the system
        // if($user->profile_image) { Storage::disk('public')->delete($user->profile_image); }
        // $user->delete();

        return redirect()->back()->with('success', 'Administrator privileges removed successfully!');
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'role' => 'admin'
        ]);

        return redirect()->back()->with('success', $user->name . ' has been promoted to Administrator successfully!');
    }
}