<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>prova show</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/show.css')}}">
</head>

</html>

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
        <div class="container">
            <div class="row justify-content-center">
                <div class="appartamenti-manager col-12">
                    <img class="apt-mng-img" src="https://wellkeptwallet.com/wp-content/uploads/Apartment-for-Air-BNB-rental.jpg" alt="">
                </div>
                <div class="row info-apt col-12 justify-content-center">
                    <div class="appartamenti col-6">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="appartamenti col-6">
                        <div class="servizi">
                            <ul>
                                <li>wi-fi</li>
                                <li>servizio in camera</li>
                                <li>telefono</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

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
                    <span class="invisible" name="place_id"> {{$place->id}}</span>
                    <input class="btn btn-primary" type="submit" value="Invia Mail">
                </form>
            @endif

        </div>
    </main>
    <footer>
      <div class="logo-img">
        <img src="https://clipart.info/images/ccovers/1499955328airbnb-2-logo-png.png" alt="logo">
      </div>
      <h3>TEAM 6</h3>
    </footer>
</body>
