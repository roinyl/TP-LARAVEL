<h1>Modifier la tache</h1>

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    titre :
    <br>
    <input type="text" name="title" value="{{ $task->title }}">
    <br>
    description :
    <br>
    <textarea name="description">{{ $task->description }}</textarea>
    <br>
    status :
    <br>
    <select name="status">
        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
        <option value="doing" {{ $task->status == 'doing' ? 'selected' : '' }}>Doing</option>
        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
    </select>
    <br>
    <button type="submit">Modifier</button>
</form>
