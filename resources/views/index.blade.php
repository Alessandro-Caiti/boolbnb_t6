@extends('layouts.layout')

@section('content')
<body>

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
@endsection
