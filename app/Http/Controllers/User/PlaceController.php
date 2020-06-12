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


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.places.index');
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
        $data['lat'] = 1;
        $data['long'] = 1;


        $validator = Validator::make($data, [
            'summary' => 'required|string|max:50',
            'price' => 'required|numeric',
            'address' => 'required|string|max:150',
            'city' => 'required|string|max:50',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'm2' => 'numeric',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.places.create')
            ->withErrors($validator)
            ->withInput();
        }

        // if (isset($data['photo'])) {
        //     $path = Storage::disk('public')->put('images', $data['photo']);
        //     $photo = new Photo;
        //     $photo->user_id = Auth::id();
        //     $photo->name = $data['title'];
        //     $photo->path = $path;
        //     $photo->description = 'Lorem ipsum';
        //     $photo->save();
        // }


        $path = Storage::disk('public')->put('images', $data['path']);

        $place = new Place;
        $place->fill($data);
        $savedPlace = $place->save();

        $infoPlace = new InfoPlace;
        $infoPlace->place_id = $place->id;
        $infoPlace->fill($data);
        $savedInfo = $infoPlace->save();
        // if(!isset($data['visible'])) {
        //     $data['visible'] = 0;
        // } else {
        //     $data['visible'] = 1;
        // }

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
        return view('user.places.edit');
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
}
