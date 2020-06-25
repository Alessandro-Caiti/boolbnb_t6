@extends('layouts.layout')

@section('content')
<main>

    <div class="container">
        <div class="my-new-home">
            <a class="btn btn-primary" href="{{route('user.places.create')}}">Inserisci una nuova casa</a>
        </div>
    @foreach ($places as $place)
        <div class="row justify-content-center">
            @foreach ($place->photo as $photo)
            <div class="appartamenti-manager col-4">
                <img class="apt-mng-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
            </div>
        @endforeach
            <div class="appartamenti-manager col-4">
                <h2>{{$place->summary}}</h2>
            </div>
            <div class="appartamenti-manager tasti col-4">
                <div class="tasto">
                    {{-- <a class="btn btn-primary" href="{{route('admin.pages.show', $page->id)}}">Visualizza</a> --}}
                    <a class="btn btn-primary" href="{{route('user.places.show', $place->id)}}">Visualizza</a>
                </div>
                <div class="tasto">
                    <a class="btn btn-secondary" href="{{route('user.places.edit', $place->id)}}">Modifica</a>
                </div>
                <div class="tasto">
                    <a class="btn btn-success" href="#">Sponsorizza</a>
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
