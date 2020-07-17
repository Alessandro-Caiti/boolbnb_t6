@extends('layouts.layout')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center my-show-container">
                <h2>{{$place->summary}}</h2>
                @foreach ($place->photo as $photo)
                <div class="appartamenti-show col-12">
                    <img class="apt-mng-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                </div>
                @endforeach
                <div class="row info-apt col-12 justify-content-center">
                    <div class="appartamenti col-6">
                        <p class="apt-description">{{$place->info->description}}</p>
                        <br>
                        <h6>Prezzo: {{$place->price}}€</h6>
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
                            <div class="form-group invisible">
                                <label for="form-zip">latitudine</label>
                                <input type="hidden" name='lat' class="form-control invisible" id="lat-show" value="{{$place->lat}}">
                            </div>
                            <div class="form-group invisible">
                                <label for="form-zip">longitudine</label>
                                <input type="hidden" name='long' class="form-control invisible" id="long-show"value="{{$place->long}}">
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
            <form class="my-message-form col-12" action="{{route('mail.store')}}" method="POST">
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
                <input type="hidden" name="place_id" value="{{$place->id}}">
                <input class="btn btn-primary" type="submit" value="Invia Mail">
            </form>
        @else
            <div class="container">
            @foreach ($place->mail as $mail)
                    <div class="my-message-container">
                        <h4>Nuovo messaggio da: {{$mail->mail}}</h4>
                        <p>{{$mail->message}}</p>
                        <form action={{route("mail.destroy" , $mail->id)}} method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Cancella Mail">
                        </form>
                    </div>
            @endforeach
            </div>
        @endif
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="{{asset('js/algoliaShow.js')}}"></script>
@endsection
