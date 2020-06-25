@extends('layouts.layout')
@section('content')
    <main>
        <div class="my-100">
            <input type="hidden" type="text" id="places-lat" value="{{$lat}}">
            <input type="hidden" type="text" id="places-long" value="{{$long}}">
            <div class="my-filter-container">
                <div class="">
                    <div class="">
                        <input class="form-group my-filter" type="number" id="beds" placeholder="Quanti letti?">
                        <input class="form-group my-filter" type="number" id="rooms" placeholder="Quante stanze?">
                    </div>
                    <div class="">
                        <input class="form-group my-filter" type="number" id="bathrooms" placeholder="Quanti bagni?">
                        <input class="form-group my-filter" type="number" id="km" placeholder="Raggio in Km?">
                    </div>
                </div>
                <div class="">
                    @foreach ($amenities as $amenity)
                        <div class="">
                            <label for="amenity-{{$amenity->id}}">{{$amenity->name}}</label>
                            <input class="check-amenity" type="checkbox" id="amenity-{{$amenity->id}}" value="{{$amenity->id}}">
                        </div>
                    @endforeach
                </div>
                <div class="">
                    <div class="">
                        <button id="btn-filter" class="btn btn-primary">Filtra</button>
                    </div>
                    <div class="">
                        <button id="btn-clear" class="btn btn-secondary">Reset Filtro</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            @foreach ($placesInRange as $place)
                <div id="{{$place->id}}" class='places'>
                    <a href="{{route('show.visit' , $place->id)}}">
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
