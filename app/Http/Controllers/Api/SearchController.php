<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Place;
use App\Amenity;
use App\InfoPlace;
use App\Photo;
use App\Mail;

class SearchController extends Controller
{
    public function searchPlaces(Request $request) {
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
            $place->info = $place->info;
            $place->amenities = $place->amenities;

            if ($place->distance <= 100) {
                foreach ($place->photo as $photo) {
                    $place->path= $photo->path;
                }

                $placesInRange[] = $place;
            }
        }
        // dati json pronti ad essere utilizzati con risultato ricerca
        // $jsonPlace= json_encode($placesInRange);
        return response()->json($placesInRange);
    }

    public function allPlace() {
        $places = Place::all();
        return response()->json($places);
    }
}
