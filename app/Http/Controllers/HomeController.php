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
        return view('user.places.index' ,  compact('places'));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $lat = $data['lat'];
        $long = $data['long'];
        $places = Place::all();
        $placesInRange = [];

        function distance($lat1, $lon1, $lat2, $lon2) {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $km = $miles * 1.609344;
            return $km;
            }


        foreach ($places as $place) {
            $placeLat = $place->lat;
            $placeLong= $place->long;

            $distanza = distance($lat, $long, $placeLat, $placeLong);
            $place->distance = $distanza;

            if ($place->distance <= 100) {
                foreach ($place->photo as $photo) {
                    $place->path= $photo->path;
                }

                $placesInRange[] = $place;
            }
        }

        $jsonPlace= json_encode($placesInRange);
        return view('search', compact('jsonPlace'));
    }
}
