<h1>Tâche(s)</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('tasks.create') }}">Ajouter une tâche</a>
<br><br>

Liste :

<ul>
    @foreach ($tasks as $task)
        <li>
            <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
            <br>

            {{ $task->description }}
            <br>

            Status : {{ $task->status }}
            <br>

            <a href="{{ route('tasks.edit', $task->id) }}">Modifier</a>

            <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Supprimer</button>
            </form>
        </li>
    @endforeach
</ul>

{{ $tasks->links() }}

<br>

<a href="{{ route('dashboard') }}">Retour au dashboard</a>