<h1>Tache(s)</h1>


@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('tasks.create') }}">Ajouter une tache</a>
</br>
liste :
<ul>
@foreach ($tasks as $task)
    <li>
        <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>        
        </br>
        {{ $task->description }}
        </br>
        status : {{ $task->status }}
        </br>
        <a href="{{ route('tasks.edit', $task->id) }}">Modifier</a>
        <form action="{{ route('tasks.delete', $task->id) }}" method="POST">            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>

            
        </form>
    </li>
@endforeach

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
</ul>

<a href="{{ route('dashboard') }}">Retour au dashboard</a>