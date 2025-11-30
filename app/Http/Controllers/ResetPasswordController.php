<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    public function create(Request $request)
    {
        $email = $request->email;

        return Inertia::render('ResetPassword/Create', [
            'email' => $email,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($validated);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function show(string $token)
    {
        // TODO: Implement show method
    }

    public function update(Request $request)
    {
        // TODO: Implement update method
    }
}
