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
        <div id="place">


        </div>




        <script id="places-list-template" type="text/x-handlebars-template">
        <div>
            <p>@{{summary}}</p>
            <p>@{{address}}</p>
            <p>@{{price}}</p>
            <img src="{{asset('storage')}}/@{{path}}">  
        </div>

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.js" charset="utf-8"></script>
        <script src="{{asset('js/search.js')}}" charset="utf-8"></script>


    </body>

</html>
