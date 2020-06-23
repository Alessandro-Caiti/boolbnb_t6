@extends('layouts.layout')

@section('content')


<body>

    <main>
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($place->photo as $photo)
                <div class="appartamenti-manager col-12">
                    <img class="apt-mng-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                </div>
                @endforeach
                <div class="row info-apt col-12 justify-content-center">
                    <h2>{{$place->summary}}</h2>
                    <div class="appartamenti col-6">
                        <p class="apt-description"> {{$place->info->description}}</p>
                    </div>
                    <div class="appartamenti col-6">
                        <div class="servizi">
                            <ul>
                                @foreach ($place->amenities as $amenity)
                                <li>{{$amenity->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <div id="map-show"></div>
                        <input type="search" id="input-map" class="form-control invisible" placeholder="Where are we going?" />
                        <div class="form-group">
                            <label for="form-zip">latitudine</label>
                            <input type="text" name='lat' class="form-control invisible" id="lat" value="{{$place->lat}}">
                        </div>
                        <div class="form-group">
                            <label for="form-zip">longitudine</label>
                            <input type="text" name='long' class="form-control invisible" id="long"value="{{$place->long}}">
                    </div>
                    <style>
                        #map-show {height: 400px};
                    </style>
                </div>
            </div>


            {{-- form per contattare proprietario, utilizzato se non si ha lo stesso id del proprietario dell'immobile--}}
    @if ($place->user_id != Auth::id())
        @foreach ($errors->all() as $message)
            {{$message}}
        @endforeach
        <form class="{{route('mail.store')}}" method="POST">
            @csrf
            @method('POST')
            <h2>Contatta {{$place->user->email}}</h2>
            <div class="form-group">
                <label for="mail">La tua Mail</label>
                <input type="email" name="mail" id="mail" class="form-control" value="{{old('mail')}}">
            </div>
            <div class="form-group">
                <label for="message">Testo del messaggio</label>
                <textarea name="message" id="message" rows="10" style='min-width:100%'>{{old('message')}}</textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="Invia Mail">
        </form>
    @else
        @foreach ($place->mail as $mail)
            <div class="<container>">
                <h2>{{$mail->mail}}</h2>
                <p>{{$mail->message}}</p>
            </div>
        @endforeach
    @endif
        </div>
    </main>
    <footer>
        <div class="logo-img">
          <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
        </div>
        <div class="row boolbnb-info">
            <div class="about-us">
                <ul>
                   <li><a href="#">Informazioni</a></li>
                   <li><a href="#">Diversità</a></li>
                   <li><a href="#">Appartenenza</a></li>
                   <li><a href="#">Affidabilità</a></li>
                </ul>
            </div>
            <div class="about-us">
                <ul>
                   <li><a href="#">Boolbnb Magazine</a></li>
                   <li><a href="#">Boolbnb Associates</a></li>
                   <li><a href="#">Boolbnb Forwork</a></li>
                   <li><a href="#">Lavora con noi</a></li>
                </ul>
            </div>
            <div class="about-us">
                <ul>
                   <li><a href="#">Diventa Host</a></li>
                   <li><a href="#">Centro Risorse</a></li>
                   <li><a href="#">Community</a></li>
                   <li><a href="#">Open Homes</a></li>
                </ul>
            </div>
            <div class="about-us">
                <ul>
                   <li><a href="#">Assistenza</a></li>
                   <li><a href="#">Cancella</a></li>
                   <li><a href="#">Servizi</a></li>
                   <li><a href="#">Centro Risorse</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="{{asset('js/algoliaShow.js')}}"></script>
</body>
  
@endsection
