<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <a href="{{ route('tasks.index') }}"
        style="display:inline-block; padding:10px 15px; background:#2563eb; color:white; border-radius:6px; text-decoration:none;">
        Aller aux tâches
    </a>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white p-4 shadow rounded">
                    <h3>Total</h3>
                    <p class="text-2xl">{{ $total }}</p>
                </div>

                <div class="bg-yellow-100 p-4 shadow rounded">
                    <h3>À faire</h3>
                    <p class="text-2xl">{{ $todo }}</p>
                </div>

                <div class="bg-blue-100 p-4 shadow rounded">
                    <h3>En cours</h3>
                    <p class="text-2xl">{{ $doing }}</p>
                </div>

                <div class="bg-green-100 p-4 shadow rounded">
                    <h3>Terminé</h3>
                    <p class="text-2xl">{{ $done }}</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>