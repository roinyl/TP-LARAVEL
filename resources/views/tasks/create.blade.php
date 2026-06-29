<h1>Creer une tache</h1>

<form action="/tasks/create" method="post">
    @csrf
    titre :
    </br>
    <input type="text" name="title">
    </br>
    description :
    </br>
    <textarea name="description"></textarea>
    </br>
    <button type="submit">Creer</button>
</form>
