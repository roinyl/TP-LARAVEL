<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes tâches
        </h2>
    </x-slot>

    <div class="p-6">

        {{-- Bouton création --}}
        <a href="{{ route('tasks.create') }}"
           class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Créer une tâche
        </a>

        {{-- Liste --}}
        <ul class="mt-4 space-y-2">
            @forelse($tasks as $task)
                <li class="p-3 border rounded flex justify-between items-center">

                    <div>
                        <strong class="text-lg">{{ $task->title }}</strong>
                        <div class="text-sm text-gray-500">
                            Status : {{ $task->status }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3">

                        {{-- Edit --}}
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a>

                        {{-- Delete --}}
                        <form method="POST"
                              action="{{ route('tasks.destroy', $task) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Supprimer cette tâche ?')"
                                    class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>

                    </div>
                </li>
            @empty
                <li class="p-4 text-gray-500">
                    Aucune tâche pour le moment.
                </li>
            @endforelse
        </ul>

    </div>
</x-app-layout>