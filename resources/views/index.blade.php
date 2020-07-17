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
                        <form class="" action="{{route('visit', $place->id)}}" id="{{$place->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="mess">
                            <a href="javascript:;" onclick="document.getElementById('{{$place->id}}').submit();">
                                <div class="place-container">
                                    <div class="polaroid">
                                        @foreach ($place->photo as $photo)
                                        <img src="{{asset('storage/'  . $photo->path)}}" alt="{{$photo->name}}" style="width:100%">
                                        @endforeach
                                        <div class="summary-container">
                                            <h5>{{$place->summary}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </form>
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
      <div class="my-paginate">
          {{$places->links()}}
      </div>

{{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{asset('js/algolia.js')}}"></script> --}}
@endsection
