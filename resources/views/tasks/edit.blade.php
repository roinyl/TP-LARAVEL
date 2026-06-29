<h1>Modifier la tâche</h1>

<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $task->title }}">
    <br><br>

    <textarea name="description">{{ $task->description }}</textarea>
    <br><br>

    <select name="status">
        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
        <option value="doing" {{ $task->status == 'doing' ? 'selected' : '' }}>Doing</option>
        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
    </select>

    <br><br>

    <button type="submit">Modifier</button>
</form>