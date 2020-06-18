<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>prova index</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
        <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

    <div class="container">
        <div id="mapid"></div>
        <input type="search" id="input-map" class="form-control" placeholder="Where are we going?" />
        <div class="form-group">
            <label for="form-zip">latitudine</label>
            <input type="text" name='lat' class="form-control" id="lat">
        </div>
        <div class="form-group">
            <label for="form-zip">longitudine</label>
            <input type="text" name='long' class="form-control" id="long">
    </div>

<style>
    #mapid {height: 300px};
</style>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script>
</html>
