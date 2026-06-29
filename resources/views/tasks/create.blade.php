<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une tâche
        </h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div>
                <label>Titre</label>
                <input type="text" name="title" class="border p-1">
            </div>

            <div class="mt-2">
                <label>Description</label>
                <textarea name="description" class="border p-1"></textarea>
            </div>

            <button type="submit" class="mt-4 bg-blue-500 text-black px-3 py-1">
                Créer
            </button>

        </form>

    </div>
</x-app-layout>