<h1>Tache(s)</h1>

<a href="/tasks/create">Ajouter une tache</a>
</br>
liste :
<ul>
@foreach ($tasks as $task)
    <li>
        <a href="/tasks/{{ $task->id }}">{{ $task->title }}</a>
        </br>
        {{ $task->description }}
        </br>
        status : {{ $task->status }}
        </br>
        <a href="/tasks/{{ $task->id }}/edit">Modifier</a>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>
