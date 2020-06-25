@extends('layouts.layout')
@section('content')
      <main>

        <div id="mapid"></div>
        <style>
          #mapid {height: 0px};
        </style>

        <div class="my-places">
            @foreach ($places as $place)
                @if ($place->visible == 1)
                    <form class="center bg" action="{{route('visit', $place->id)}}" id="{{$place->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <a href="javascript:;" onclick="document.getElementById('{{$place->id}}').submit();">
                        <input type="hidden" name="mess">
                        <div class="my-place">
                        {{-- <input id="invia-form" class="btn btn-primary" type="submit" value="Visualizza appartamento"> --}}

                            <div class="index-place-container">
                                @foreach ($place->photo as $photo)
                                <div class="index-place-foto">
                                    <img class="index-img" src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}">
                                </div>
                                @endforeach
                                <div class="index-place-summary">
                                    <h2>{{$place->summary}}</h2>
                                </div>
                            </div>
                        </div>
                        </a>
                    </form>
                @endif
            @endforeach
        </div>

      </main>

{{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script> --}}
@endsection
