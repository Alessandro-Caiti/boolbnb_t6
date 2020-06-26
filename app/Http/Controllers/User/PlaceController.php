<?php

namespace App\Http\Controllers\User;

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
use App\Visit;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $places = Place::where('user_id' , $id)->get();
        return view('user.places.index' ,  compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::all();
        $photos = Photo::all();
        return view('user.places.create', compact('amenities', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['summary'], '-') ;

        if(!isset($data['visible'])) {
                   $data['visible'] = 0;
               } else {
                   $data['visible'] = 1;
               }

        $validator = Validator::make($data, [
            'summary' => 'required|string|max:50',
            'price' => 'required|numeric',
            'address' => 'required|string|max:150',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'm2' => 'numeric',
            'description' => 'required',
            'path' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.places.create')
            ->withErrors($validator)
            ->withInput();
        }

        $path = Storage::disk('public')->put('images', $data['path']);

        $place = new Place;
        $place->fill($data);
        $savedPlace = $place->save();

        $infoPlace = new InfoPlace;
        $infoPlace->place_id = $place->id;
        $infoPlace->fill($data);
        $savedInfo = $infoPlace->save();

        if (isset($data['path'])) {
            $path = Storage::disk('public')->put('images', $data['path']);
            $photo = new Photo;
            $photo->place_id = $place->id;
            $photo->name = $data['summary'];
            $photo->path = $path;
            $photo->save();
        }
        $place->amenities()->attach($data['amenities']);
        return redirect()->route('user.places.show' , $place->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $place = Place::findOrFail($id);
      // $infoPlace = InfoPlace::where('place_id' , $id)->first();
      // $mails = Mail::where('place_id' , $id)->get();
      // return view('user.places.show' , compact('place', 'infoPlace' , 'mails'));
      return view('user.places.show' , compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::id();
        $place = Place::findOrFail($id);
        $amenities = Amenity::all();
        $photos = Photo::all();
        // $infoPlace = InfoPlace::where('place_id' , $id)->first();
        if ($userId != $place->user_id) {
            abort('404');
        }
        return view('user.places.edit' , compact('place' , 'amenities' , 'photos'));
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
        $userId = Auth::id();
        $place = Place::findOrFail($id);
        $infoPlace = InfoPlace::where('place_id' , $id)->first();
        if ($userId != $place->user_id) {
            abort('404');
        }

        $data = $request->all();

        if(!isset($data['visible'])) {
                   $data['visible'] = 0;
               } else {
                   $data['visible'] = 1;
               }

        $data['slug'] = Str::slug($data['summary'], '-') ;
        $validator = Validator::make($data, [
            'summary' => 'required|string|max:50',
            'price' => 'required|numeric',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'm2' => 'numeric',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        // $path = Storage::disk('public')->put('images', $data['path']);

        $place->fill($data);
        $savedPlace = $place->update();

        $infoPlace->fill($data);
        $savedInfo = $infoPlace->update();

        // if (isset($data['path'])) {
        //     $path = Storage::disk('public')->put('images', $data['path']);
        //     $photo = new Photo;
        //     $photo->place_id = $place->id;
        //     $photo->name = $data['summary'];
        //     $photo->path = $path;
        //     $photo->save();
        // }
        $place->amenities()->sync($data['amenities']);
        return redirect()->route('user.places.show' , $place->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::id();
        $place = Place::findOrFail($id);
        if ($userId != $place->user_id) {
            abort('404');
        }
        $place->amenities()->detach();
        $place->photo()->delete();
        $place->info()->delete();
        $place->delete();

        return redirect()->route('user.places.index');
    }

    public function stat($id)
    {
        $userId = Auth::id();
        $place = Place::findOrFail($id);
        if ($userId != $place->user_id) {
            abort('404');
        }
        return view('user.places.stat' , compact('place'))->with('id' , $id);
    }
}
