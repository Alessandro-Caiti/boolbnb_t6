<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Visit;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $places = Place::orderBy('created_at', 'desc')->paginate(10);
        return view('index' ,  compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function search(Request $request) {
         $data = $request->all();
         $lat = $data['lat'];
         $long = $data['long'];
         $places = Place::all();
         $amenities = Amenity::all();
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
                 $placesInRange[] = $place;
            }
        }

        function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
            $reference_array = array();
            foreach($array as $key => $row) {
                $reference_array[$key] = $row[$column];
            }
            array_multisort($reference_array, $direction, $array);
        }

        array_sort_by_column($placesInRange, 'distance');

        return view('search' , compact('placesInRange' , 'amenities'))->with('lat' , $lat)->with('long' , $long);
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        return view('show' , compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function visit($id) {
        $userId = Auth::id();
        $place = Place::findOrFail($id);
        if ($userId != $place->user_id) {
            $visit = new Visit;
            $visit->place_id = $id;
            $visit->save();
            return view('show' , compact('place'));
        }
            else {
                return view('user.places.show' , compact('place'));
            }
    }
}
