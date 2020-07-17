<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'summary',
        'slug',
        'price',
        'address',
        'lat',
        'long',
        'visible'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function info()
    {
        return $this->hasOne('App\InfoPlace');
    }

    public function sponsor()
    {
        return $this->hasOne('App\Sponsor');
    }

    public function photo()
    {
        return $this->hasMany('App\Photo');
    }

    public function mail()
    {
        return $this->hasMany('App\Mail');
    }

    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    public function amenities()
    {
        return $this->belongsToMany('App\Amenity');
    }
}
