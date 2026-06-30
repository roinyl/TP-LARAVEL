<h1>Créer une tâche</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <label for="title">Titre :</label>
    <br>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title') }}"
    >
    <br>

    <label for="description">Description :</label>
    <br>
    <textarea
        id="description"
        name="description"
    >{{ old('description') }}</textarea>
    <br>

    <button type="submit">Créer</button>
</form>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
