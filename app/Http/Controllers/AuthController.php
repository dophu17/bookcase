<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', __('app.login_success'));
        }

        return back()->withErrors([
            'email' => __('app.login_error'),
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', __('app.register_success'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', __('app.logout_success'));
    }

    /**
     * Show the profile form for the authenticated user.
     */
    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Update the authenticated user's profile (name).
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile')->with('success', __('app.profile_updated'));
    }

    /**
     * Show the settings form for the authenticated user.
     */
    public function showSettings()
    {
        $user = Auth::user();
        $setting = $user->setting;
        return view('auth.settings', compact('user', 'setting'));
    }

    /**
     * Update the authenticated user's settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'daily_reminder_time' => ['required', 'string'],
            'spending_limit' => ['required', 'numeric', 'min:0'],
        ]);

        $user = Auth::user();
        $setting = $user->setting;
        if (!$setting) {
            $setting = $user->setting()->create([
                'daily_reminder_time' => $request->daily_reminder_time,
                'spending_limit' => $request->spending_limit,
            ]);
        } else {
            $setting->update([
                'daily_reminder_time' => $request->daily_reminder_time,
                'spending_limit' => $request->spending_limit,
            ]);
        }

        return redirect()->route('settings')->with('success', __('app.settings_updated'));
    }
} 