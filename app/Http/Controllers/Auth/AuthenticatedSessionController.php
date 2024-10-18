<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User; // Import the User model
use App\Models\UserDetails;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Store last login timestamp
        $user = Auth::user();
        UserDetails::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_name' => $user->name, // Update user_name
                'last_login_at' => Carbon::now('Asia/Karachi') // Update last_login_at
            ]// Update last_login_at
        );

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = Auth::user(); // Get the authenticated user

        // Store last logout timestamp
        if ($user) {
            UserDetails::updateOrCreate(
                ['user_id' => $user->id], // Find by user_id
                ['last_logout_at' => Carbon::now('Asia/Karachi')] // Update last_logout_at
            );
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}