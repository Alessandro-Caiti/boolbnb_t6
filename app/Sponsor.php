<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'place_id',
        'expiration'
    ];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
