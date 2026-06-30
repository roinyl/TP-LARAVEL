<x-guest-layout>
    <form method="POST" action="{{ route('two-factor.challenge') }}">
        @csrf

        <div>
            <x-input-label for="code" :value="__('Authentication code')" />
            <x-text-input
                id="code"
                type="text"
                name="code"
                inputmode="numeric"
                pattern="[0-9]*"
                autocomplete="one-time-code"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('code')" />
        </div>

        <div>
            <x-primary-button>
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
