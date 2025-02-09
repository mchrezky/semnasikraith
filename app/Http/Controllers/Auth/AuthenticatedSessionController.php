<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        // Verifikasi reCAPTCHA
        if ($request->validateRecaptcha()) {
            // Cek kredensial login
            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard', absolute: false));
            } else {
                return back()->withInput()->withErrors(['password' => 'Email atau password salah.']);
            }
        } else {
            // Jika reCAPTCHA gagal
            return back()->withInput()->withErrors(['captcha' => 'Verifikasi reCAPTCHA gagal.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
