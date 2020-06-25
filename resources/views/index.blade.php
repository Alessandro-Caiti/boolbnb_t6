@extends('layouts.layout')
@section('content')
      <main>

        <div id="mapid"></div>
        <style>
          #mapid {height: 0px};
        </style>

        <div class="my-places justify-content-center row">
            @foreach ($places as $place)
                @if ($place->visible == 1)
                    <div class="card-container col-12 col-md-6">
                        <div class="place-container">
                            <a href="{{route('show', $place->id)}}">
                                <div class="polaroid">
                                    @foreach ($place->photo as $photo)
                                    <img src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}" style="width:100%">
                                    @endforeach
                                    <div class="summary-container">
                                        <h5>{{$place->summary}}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="my-place">
                        <a href="{{route('show', $place->id)}}">
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
                        </a>
                    </div> --}}
                @endif
            @endforeach
        </div>

      </main>

{{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script> --}}
@endsection
