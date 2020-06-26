<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Place;
use App\Amenity;
use App\InfoPlace;
use App\Photo;
use App\Mail;
use App\Visit;
class StatController extends Controller
{
    public function getData(Request $request) {
        $data = $request->all();
        $id = $data['id'];
        $stat = Visit::where('place_id', $id)->get();
        return response()->json($stat);
    }
}
