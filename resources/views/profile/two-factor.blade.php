<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Authentification à deux facteurs</h2>
    </x-slot>

    <div class="p-6 space-y-6">

        @if (! auth()->user()->two_factor_secret)

            <form method="POST" action="/user/two-factor-authentication">
                @csrf
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Activer l’A2F
                </button>
            </form>

        @else

            {{-- QR CODE --}}
            <div class="p-4 bg-gray-100 rounded">
                <h3 class="font-bold mb-3">Scanner le QR code</h3>

                {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>

            {{-- CLÉ MANUELLE (IMPORTANT) --}}
            <div class="p-4 bg-gray-50 border rounded">
                <h3 class="font-bold mb-2">
                    Clé manuelle (si scan impossible)
                </h3>

                <p class="font-mono text-lg break-all">
                    {{ decrypt(auth()->user()->two_factor_secret) }}
                </p>
            </div>

            {{-- CONFIRMATION --}}
            @if (! auth()->user()->two_factor_confirmed_at)

                <form method="POST" action="/user/confirmed-two-factor-authentication">
                    @csrf

                    <input type="text"
                           name="code"
                           placeholder="Code 6 chiffres"
                           class="border p-2 rounded w-full">

                    <button class="bg-green-600 text-white px-4 py-2 rounded mt-3">
                        Valider
                    </button>
                </form>

            @else
                <p class="text-green-600 font-bold">
                    A2F activée ✔
                </p>
            @endif

        @endif

    </div>
</x-app-layout>