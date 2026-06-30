<section>
    <header>
        <h2>
            {{ __('Two-Factor Authentication') }}
        </h2>

        <p>
            {{ __('Use Microsoft Authenticator or another authenticator app to protect your account.') }}
        </p>
    </header>

    @if (! $user->two_factor_secret)
        <form method="post" action="{{ route('two-factor.enable') }}">
            @csrf

            <x-primary-button>
                {{ __('Enable two-factor authentication') }}
            </x-primary-button>
        </form>
    @elseif (! $user->hasEnabledTwoFactorAuthentication())
        <div>
            <p>
                {{ __('Scan this QR code with Microsoft Authenticator, then enter the six-digit code.') }}
            </p>

            <div>
                {!! $twoFactorQrCodeSvg !!}
            </div>

            <div>
                <x-input-label for="two_factor_secret" :value="__('Secret key')" />
                <x-text-input id="two_factor_secret" type="text" :value="$user->two_factor_secret" readonly />
            </div>

            <form method="post" action="{{ route('two-factor.confirm') }}">
                @csrf

                <div>
                    <x-input-label for="code" :value="__('Authentication code')" />
                    <x-text-input
                        id="code"
                        name="code"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        autocomplete="one-time-code"
                    />
                    <x-input-error :messages="$errors->get('code')" />
                </div>

                <div>
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="post" action="{{ route('two-factor.disable') }}">
                @csrf
                @method('delete')

                <x-secondary-button type="submit">
                    {{ __('Cancel setup') }}
                </x-secondary-button>
            </form>
        </div>
    @else
        <div>
            <p>
                {{ __('Two-factor authentication is enabled.') }}
            </p>

            @if (session('status') === 'two-factor-confirmed')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Saved.') }}</p>
            @endif

            <form method="post" action="{{ route('two-factor.disable') }}">
                @csrf
                @method('delete')

                <x-secondary-button type="submit">
                    {{ __('Disable two-factor authentication') }}
                </x-secondary-button>
            </form>
        </div>
    @endif
</section>
