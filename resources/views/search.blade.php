@extends('layouts.layout')
@section('content')
    <main>
        <div class="">
            <input type="hidden" type="text" id="places-lat" value="{{$lat}}">
            <input type="hidden" type="text" id="places-long" value="{{$long}}">
            <div class="">
                <input class="form-group" type="number" id="beds" placeholder="Inserisci il numero di letti">
                <input class="form-group" type="number" id="rooms" placeholder="Inserisci il numero di stanze">
                <input class="form-group" type="number" id="bathrooms" placeholder="Inserisci il numero di bagni">

                @foreach ($amenities as $amenity)
                    <label for="amenity-{{$amenity->id}}">{{$amenity->name}}</label>
                    <input class="check-amenity" type="checkbox" id="amenity-{{$amenity->id}}" value="{{$amenity->id}}">
                @endforeach

                <button id="btn-filter" class="btn btn-primary">Filtra</button>
                <button id="btn-clear" class="btn btn-secondary">Reset Filtro</button>
            </div>
        </div>
        <div class="">
            @foreach ($placesInRange as $place)
                <div id="{{$place->id}}">
                    <a href="{{route('show' , $place->id)}}">
                        <div>
                            <h2>{{$place->summary}}</h2>
                            <p>{{$place->address}}</p>
                            @foreach ($place->photo as $photo)
                            <div class="appartamenti-manager col-12">
                                <img class="apt-mng-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                            </div>
                            @endforeach
                            @foreach ($place->amenities as $amenity)
                                <p class="amenities" data-amenities="{{$amenity->id}}">{{$amenity->name}}</p>
                            @endforeach
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <script src="{{asset('js/search.js')}}" charset="utf-8"></script>
    </main>
@endsection
