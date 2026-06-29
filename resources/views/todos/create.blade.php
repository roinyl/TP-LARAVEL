<h1>Créer un TODO</h1>

<form action="/todos/create" method="post">
    @csrf
    titre : 
    </br>
    <input type="text" name="title" />
    </br>
    description : 
    </br>
    <textarea name="description"></textarea>
    </br>
    <button type="submit">Créer</button>
</form>
