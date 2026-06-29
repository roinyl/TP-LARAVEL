<x-app-layout>
    <x-slot name="header">
        <h2>
            Dashboard
        </h2>
    </x-slot>

    <a href="{{ route('tasks.index') }}"
        >
        Aller aux tâches
    </a>

    <div>
        <div>

            <div>

                <div>
                    <h3>Total</h3>
                    <p>{{ $total }}</p>
                </div>

                <div>
                    <h3>À faire</h3>
                    <p>{{ $todo }}</p>
                </div>

                <div>
                    <h3>En cours</h3>
                    <p>{{ $doing }}</p>
                </div>

                <div>
                    <h3>Terminé</h3>
                    <p>{{ $done }}</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
