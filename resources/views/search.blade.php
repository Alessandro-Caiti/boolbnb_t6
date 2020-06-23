<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Ricerca</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <input type="hidden" type="text" id="places-lat" value="{{$lat}}">
        <input type="hidden" type="text" id="places-long" value="{{$long}}">
        <div class="form-control">
            <input class="form-group" type="number" id="beds" placeholder="Nr. letti">
            <input class="form-group" type="number" id="rooms" placeholder="Nr. stanze">
            <input class="form-group" type="number" id="bathrooms" placeholder="Nr. bagni">
            <input class="form-group" type="number" id="km" placeholder="Raggio in Km">

            @foreach ($amenities as $amenity)
                <label for="amenity-{{$amenity->id}}">{{$amenity->name}}</label>
                <input class="check-amenity" type="checkbox" id="amenity-{{$amenity->id}}" value="{{$amenity->id}}">
            @endforeach

            <button id="btn-filter" class="btn btn-primary">Filtra</button>
            <button id="btn-clear" class="btn btn-secondary"> Reset Filtri </button>
        </div>





    @foreach ($placesInRange as $place)
        <div id="{{$place->id}}" class="places">
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





        <script src="{{asset('js/search.js')}}" charset="utf-8"></script>


    </body>

</html>
