<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
// use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): RedirectResponse
    {
        return redirect('/');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => ['required', 'string', 'in:alumni,account_officer'],

            'student_id' => [$request->role === 'alumni' ? 'required' : 'nullable', 'string', 'max:50'],
            'batch' => [$request->role === 'alumni' ? 'required' : 'nullable', 'string', 'max:50'],
            'session' => [$request->role === 'alumni' ? 'required' : 'nullable', 'string', 'max:50'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        // $status = ($request->role === 'alumni') ? 'pending' : 'active';
        $imagePath = null;

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile_image', $filename, 'public');
            $imagePath = 'profile_image/' . $filename;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 94b6e29863c11c24022e708633b5f8159caf365e
            'role' => $request->role,
            'status' => $status,
=======
            'role' => 'alumni',
            'status' => 'pending',
            'student_id' => $request->student_id,
            'batch' => $request->batch,
            'session' => $request->session,
            'profile_image' => $imagePath,
>>>>>>> origin/dev_shabnam
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}