<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'place_id',
        'name',
        'path',
        'description'
    ];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
