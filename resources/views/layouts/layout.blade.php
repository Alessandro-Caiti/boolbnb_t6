<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
  <header>
    <a class="navbar-brand" href="{{ url('/') }}">
        {{-- {{ config('app.name', 'Laravel') }} --}}
        <div class="logo-img">
          <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
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
            </div>
        </nav>
    </div>
  </header>

            @yield('content')

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
        <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
        <script src="{{asset('js/algolia.js')}}"></script>
</body>
</html>
