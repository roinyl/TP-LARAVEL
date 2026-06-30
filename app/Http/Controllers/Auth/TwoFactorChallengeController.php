<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwoFactorAuthenticator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function create(Request $request): RedirectResponse|View
    {
        if (! $request->session()->has('login.two_factor.user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-challenge');
    }

    public function store(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
        ]);

        $login = $request->session()->get('login.two_factor');

        if (! $login || ! $user = User::find($login['user_id'])) {
            return redirect()->route('login');
        }

        if (! $user->hasEnabledTwoFactorAuthentication() || ! $authenticator->verify($user->two_factor_secret, (string) $request->string('code'))) {
            throw ValidationException::withMessages([
                'code' => __('The authentication code is invalid.'),
            ]);
        }

        Auth::login($user, (bool) ($login['remember'] ?? false));

        $request->session()->forget('login.two_factor');
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
