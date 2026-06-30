<x-guest-layout>
    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div>
            <x-input-label for="code" value="Code 2FA" />
            <x-text-input id="code" type="text" name="code" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('code')" />
        </div>

        <div>
            <x-primary-button>
                Valider
            </x-primary-button>
        </div>
    </form>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div>
            <x-input-label for="recovery_code" value="Code de recuperation" />
            <x-text-input id="recovery_code" type="text" name="recovery_code" autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('recovery_code')" />
        </div>

        <div>
            <x-primary-button>
                Utiliser le code de recuperation
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
