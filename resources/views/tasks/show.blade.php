Ma tache : {{ $task->title }}

<br>
{{ $task->description }}

<br>
status : {{ $task->status }}

<br>
<a href="{{ route('tasks.index') }}">Retour</a>
