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
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'no_telp' => ['required', 'string', 'lowercase', 'max:20', 'unique:' . User::class],
            'tipe_user' => ['required', 'string', 'max:50'],
            'institusi_asal' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => ['required', 'string'],
        ]);

        if (!$this->validateRecaptcha($request)) {
            throw ValidationException::withMessages([
                'captcha' => 'The reCAPTCHA verification failed.',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'tipe_user' => $request->tipe_user,
            'institusi_asal' => $request->institusi_asal,
            'alamat' => $request->alamat,
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Validate Google reCAPTCHA.
     */
    private function validateRecaptcha(Request $request): bool
    {
        $response = $request->input('g-recaptcha-response');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $response,
        ]);

        $body = $response->json();
        return $body['success'] ?? false;
    }
}
