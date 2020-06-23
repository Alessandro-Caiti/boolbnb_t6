@extends('layouts.layout')
@section('content')
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

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script>
@endsection
