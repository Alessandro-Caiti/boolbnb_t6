<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\User;
use App\Place;
use App\Amenity;
use App\InfoPlace;
use App\Photo;
use App\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $places = Place::where('user_id' , $id)->get();
        return view('index' ,  compact('places'));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $lat = $data['lat'];
        $long = $data['long'];
        return view('search')->with('lat' , $lat)->with('long' , $long);
    }

    public function show($id)
    {
      $place = Place::findOrFail($id);
      return view('show' , compact('place'));
    }
}
