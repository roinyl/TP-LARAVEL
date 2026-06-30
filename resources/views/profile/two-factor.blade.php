<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">

        <h1 class="text-xl font-bold mb-6">
            Sécurité du compte
        </h1>

        @if (! auth()->user()->two_factor_secret)

            <form method="POST" action="/user/two-factor-authentication">
                @csrf

                <button class="px-4 py-2 bg-black text-white rounded">
                    Activer l’authentification à deux facteurs
                </button>
            </form>

        @else

            <div class="mb-6">
                <h2 class="font-semibold mb-2">QR Code</h2>

                <div class="p-4 bg-white inline-block">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                <p class="text-sm text-gray-500 mt-2">
                    Scanne ce code avec Microsoft Authenticator
                </p>
            </div>

            <div class="mb-6">
                <h2 class="font-semibold mb-2">Code de confirmation</h2>

                <form method="POST" action="/user/confirmed-two-factor-authentication">
                    @csrf

                    <input
                        type="text"
                        name="code"
                        class="border p-2 w-full rounded"
                        placeholder="Code à 6 chiffres"
                    />

                    <button class="mt-2 px-4 py-2 bg-green-600 text-white rounded">
                        Valider
                    </button>
                </form>
            </div>

            <form method="POST" action="/user/two-factor-authentication">
                @csrf
                @method('DELETE')

                <button class="px-4 py-2 bg-red-600 text-white rounded">
                    Désactiver
                </button>
            </form>

        @endif

    </div>
</x-app-layout>