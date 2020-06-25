@extends('layouts.layout')
@section('content')
      <main>

        <div id="mapid"></div>
        <style>
          #mapid {height: 0px};
        </style>

        <div class="index-appartamenti">
            @foreach ($places as $place)
                @if ($place->visible == 1)
                    <a href="{{route('show', $place->id)}}">
                        <div class="index-place-container">
                            @foreach ($place->photo as $photo)
                            <div class="my-place-foto">
                                <img class="index-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                            </div>
                            @endforeach
                            <div class="index-place-summary">
                                <h2>{{$place->summary}}</h2>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
      </main>

{{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script> --}}
@endsection
