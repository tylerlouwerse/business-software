<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class SetupController extends Controller
{
    public function show()
    {
        // If users already exist, redirect to dashboard
        if (User::count() > 0) {
            return redirect()->route('dashboard');
        }

        return Inertia::render('Setup/Admin');
    }

    public function store(Request $request)
    {
        // If users already exist, redirect to dashboard
        if (User::count() > 0) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create the first user (super admin)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Mark app setup as completed in cache
        Cache::forever('app.setup.completed', true);

        // Auto-login the user
        Auth::login($user);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('status', 'App setup completed successfully!');
    }
}
