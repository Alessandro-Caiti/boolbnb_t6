<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <input type="hidden" type="text" id="places-lat" value="{{$lat}}">
        <input type="hidden" type="text" id="places-long" value="{{$long}}">
    </body>
    <script src="{{asset('js/search.js')}}" charset="utf-8"></script>
</html>
