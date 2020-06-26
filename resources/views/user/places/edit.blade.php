<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12 my-create-edit">
                        {{-- sezione di gestione errori nel caso di ritorno dalla funzione store --}}
                        @foreach ($errors->all() as $message)
                            {{$message}}
                        @endforeach
                        {{-- Fine sezione --}}
                        {{-- Nel form imposto l'azione, il medoto e l'enctype (Senza quest'ultimo non posso recuperare file) --}}
                        <form action="{{route('user.places.update' , $place->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="summary">Sommario</label>
                                <input type="text" name="summary" id="summary" class="form-control" value="{{$place['summary']}}">
                            </div>
                            <div class="form-group">
                                <label for="price">Prezzo</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{$place['price']}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Descrizione</label>
                                <div class="">
                                    <textarea name="description" id="description" rows="10" style='min-width:100%'>{{$place->info->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rooms">Numero stanze</label>
                                <input type="text" name="rooms" id="rooms" class="form-control" value="{{$place->info->rooms}}">
                            </div>
                            <div class="form-group">
                                <label for="beds">Posti letto</label>
                                <input type="text" name="beds" id="beds" class="form-control" value="{{$place->info->beds}}">
                            </div>
                            <div class="form-group">
                                <label for="bathrooms">Servizi igienici</label>
                                <input type="text" name="bathrooms" id="bathrooms" class="form-control" value="{{$place->info->bathrooms}}">
                            </div>
                            <div class="form-group">
                                <label for="m2">Metri quadri</label>
                                <input type="text" name="m2" id="m2" class="form-control" value="{{$place->info->m2}}">
                            </div>

                            <div class="form-group">
                                <h3>Servizi</h3>
                                {{-- ciclo for each per visualizzare tutte i tag presenti nel db, tag-id per il valore nel db, tag name per la comprensione dell'id associato --}}
                                @foreach ($amenities as $amenity)
                                    <label for="amenities-{{$amenity->id}}">{{$amenity->name}}</label>
                                    {{-- Se esiste un array con gli elementi old E se i dati combaciano con i dati della tabella tag, ALLORA CHECKED --}}
                                    <input type="checkbox" name="amenities[]" id="amenities-{{$amenity->id}}" value="{{$amenity->id}}"
                                    {{((is_array(old('amenities')) && in_array($amenity->id, old('amenities')))||($place->amenities->contains($amenity->id))) ? 'checked' : ''}}>
                                @endforeach

                            </div>

                            <div class="form-group">
                              <!-- Default switch -->
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible">
                                  <label class="custom-control-label" for="customSwitches">Visible</label>
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Invia Dati">
                            <a class="btn btn-danger" href="{{route('user.places.index')}}">Torna indietro senza salvare</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="{{asset('js/algolia.js')}}" charset="utf-8"></script>
</html>
