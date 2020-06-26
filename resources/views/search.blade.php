@extends('layouts.layout')
@section('content')
    <main class="src-main">
        <div class="my-100">
            <input type="hidden" type="text" id="places-lat" value="{{$lat}}">
            <input type="hidden" type="text" id="places-long" value="{{$long}}">
            <div class="my-filter-container row">
                <div class="my-src-inputs col-12 col-sm-4">
                    <div class="">
                        <input class="form-group my-filter"  type="number" id="beds" placeholder="Quanti letti?">
                        <input class="form-group my-filter"  type="number" id="rooms" placeholder="Quante stanze?">
                    </div>
                    <div class="">
                        <input class="form-group my-filter"  type="number" id="bathrooms" placeholder="Quanti bagni?">
                        <input class="form-group my-filter" type="number" id="km" placeholder="Raggio in Km?">
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    @foreach ($amenities as $amenity)
                        <div class="">
                            <label for="amenity-{{$amenity->id}}">{{$amenity->name}}</label>
                            <input class="check-amenity" type="checkbox" id="amenity-{{$amenity->id}}" value="{{$amenity->id}}">
                        </div>
                    @endforeach
                </div>
                <div class="my-src-buttons col-12 col-sm-4">
                    <div class="my-button-container">
                        <button id="btn-filter" class="btn btn-primary">Filtra</button>
                    </div>
                    <div class="my-button-container">
                        <button id="btn-clear" class="btn btn-secondary">Reset Filtro</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-src-places">
            @foreach ($placesInRange as $place)
                {{-- <div id="{{$place->id}}" class='places'>
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
                </div> --}}
                @if ($place->visible == 1)
                    <div id="{{$place->id}}" class="card-container col-12 places">
                        <form class="" action="{{route('visit', $place->id)}}" id="form-{{$place->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <a href="javascript:;" onclick="$('#form-{{$place->id}}').submit();">
                                <div class="place-container">
                                    <div class="polaroid">
                                        {{-- <input type="submit" name="mess" value="visualizza"> --}}
                                        @foreach ($place->photo as $photo)
                                        <img src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}" style="width:100%">
                                        @endforeach
                                        <div class="summary-container">
                                            <h5>{{$place->summary}}</h5>
                                        </div>
                                        @foreach ($place->amenities as $amenity)
                                            <p class="amenities invisible" data-amenities="{{$amenity->id}}">{{$amenity->name}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
        <script src="{{asset('js/search.js')}}" charset="utf-8"></script>
    </main>
@endsection
