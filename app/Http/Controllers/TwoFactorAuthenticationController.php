<?php

namespace App\Http\Controllers;

use App\Services\TwoFactorAuthenticator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthenticationController extends Controller
{
    public function store(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $request->user()->forceFill([
            'two_factor_secret' => $authenticator->generateSecret(),
            'two_factor_confirmed_at' => null,
        ])->save();

        return back()->with('status', 'two-factor-enabled');
    }

    public function confirm(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
        ]);

        $user = $request->user();

        if (! filled($user->two_factor_secret) || ! $authenticator->verify($user->two_factor_secret, (string) $request->string('code'))) {
            throw ValidationException::withMessages([
                'code' => __('The authentication code is invalid.'),
            ]);
        }

        $user->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        return back()->with('status', 'two-factor-confirmed');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->forceFill([
            'two_factor_secret' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return back()->with('status', 'two-factor-disabled');
    }
}
