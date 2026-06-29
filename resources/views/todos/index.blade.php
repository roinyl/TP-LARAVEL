<h1>TODO(s)</h1>

<a href='/todos/create'>Ajouter un TODO</a>
</br>
liste : 
<ul>
@foreach ($salut as $todo)

<li>
    {{ $todo->title }}
   </br>
   {{ $todo->description }}

   <form action='/todos/{{ $todo->id }}' method='POST'>
       @csrf
       @method('DELETE')
       <button type='submit'>Delete</button>
   </form>
</li>
@endforeach

</ul>