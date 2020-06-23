<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Index Guest</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
  <body>
    <main>
      <h1>Team 6 presents:</h1>
        <a href="{{route('home')}}"><button class="enjoy" type="submit" name="button">Enjoy!</button></a>
    </main>
  </body>
</html>
