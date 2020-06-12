<h1>{{$place->summary}}</h1>
<p>{{$place->info->description}}</p>

<a class="btn btn-info" href="{{route('user.places.edit', $place->id)}}">Modifica</a>

<form action="{{route('user.places.destroy', $place->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <input class="btn btn-danger" type="submit" value="Elimina">
</form>
