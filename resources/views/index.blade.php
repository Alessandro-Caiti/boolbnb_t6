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
        <div class="nav">
            <form action="{{route('search')}}" method="post">
                @csrf
                @method('GET')
                <div class="form-group">
                    <input type="search" class="form-control" name ="search" id="input-map" placeholder="Dove andiamo?" />
                    <div class="invisible" id="mapid"></div>
                </div>
                <div class="form-group invisible">
                    <label for="form-zip">latitudine</label>
                    <input type="text" name='lat' class="form-control" id="lat">
                </div>
                <div class="form-group invisible">
                    <label for="form-zip">longitudine</label>
                    <input type="text" name='long' class="form-control" id="long">
                </div>
                <input class="btn btn-primary" type="submit" value="Cerca">
            </form>
        </div>
        {{-- <div class="">
            form con rotta search
            bottone submit con rotta search e gli passo lat e long

            https://stackoverflow.com/questions/29814209/getting-the-form-input-value-in-laravel

            <form action="{{{ url("search/$posizione") }}}" method="get">
                <input type="hidden" name ="status_Id" value="{{$swagger->status_Id}}">
                <input type="submit" value="Delete">
            </form>
        </div> --}}
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

          <div id="mapid"></div>
          <style>
              #mapid {height: 0px};
          </style>
        <div class="appartamenti-sponsor">

        </div>
        <div class="appartamenti">

        </div>
      </main>

      {{-- <footer>
        <div class="logo-img">
          <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
        </div>
        <h3>TEAM 6</h3>
      </footer> --}}

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
                     <li><a href="#">Affiddabilià</a></li>
                  </ul>
              </div>
              <div class="about-us">
                  <ul>
                     <li><a href="#">Informazioni</a></li>
                     <li><a href="#">Diversità</a></li>
                     <li><a href="#">Appartenenza</a></li>
                     <li><a href="#">Affiddabilià</a></li>
                  </ul>
              </div>
              <div class="about-us">
                  <ul>
                     <li><a href="#">Informazioni</a></li>
                     <li><a href="#">Diversità</a></li>
                     <li><a href="#">Appartenenza</a></li>
                     <li><a href="#">Affiddabilià</a></li>
                  </ul>
              </div>
              <div class="about-us">
                  <ul>
                     <li><a href="#">Informazioni</a></li>
                     <li><a href="#">Diversità</a></li>
                     <li><a href="#">Appartenenza</a></li>
                     <li><a href="#">Affiddabilià</a></li>
                  </ul>
              </div>
          </div>
      </footer>
  </body>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script>
</html>
