<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>prova index</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
        <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
      <header>
        <div class="logo-img">
          <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
        </div>
        <div class="research">
          <input type="search" id="input-map" class="form-control" placeholder="Dove vuoi andare?" />
        </div>
        <div class="login">
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
        </div>
      </header>

      <main>
        <div class="appartamenti-sponsor">

        </div>
        <div class="appartamenti">

        </div>
        <div class="container">
          <div id="mapid"></div>
        </div>
      </main>

      {{-- <footer>
        <div class="logo-img">
          <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
        </div>
        <h3>TEAM 6</h3>
      </footer> --}}

<style>
  #mapid {height: 0px};
</style>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script>
</html>
