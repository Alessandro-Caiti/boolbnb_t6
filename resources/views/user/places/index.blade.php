@extends('layouts.layout')

@section('content')
<main>

    <div class="container">
        <div class="my-new-home">
            <a class="btn btn-primary" href="{{route('user.places.create')}}">Inserisci una nuova casa</a>
        </div>
    @foreach ($places as $place)
        <div class="my-dash-container">
            <div class="my-dash-flex">
                @foreach ($place->photo as $photo)
                <div class="appartamenti-manager col-6">
                    <img class="apt-mng-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                </div>
            @endforeach
                <div class="appartamenti-manager col-6">
                    <h2>{{$place->summary}}</h2>
                </div>
            </div>
            <div class="my-tasti">
                <div class="tasto">
                    {{-- <a class="btn btn-primary" href="{{route('admin.pages.show', $page->id)}}">Visualizza</a> --}}
                    <a class="btn btn-primary" href="{{route('user.places.show', $place->id)}}">Visualizza</a>
                </div>
                <div class="tasto">
                    <a class="btn btn-secondary" href="{{route('user.places.edit', $place->id)}}">Modifica</a>
                </div>
                <div class="tasto">
                    <a class="btn btn-success" href="{{route('stat', $place->id)}}">Statistiche</a>
                </div>
                <div class="tasto">
                    <form action={{route("user.places.destroy" , $place->id)}} method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Elimina">
                    </form>
                </div>
            </div>
        </div>

    @endforeach
    </div>
    </main>
@endsection
