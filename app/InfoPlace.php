<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoPlace extends Model
{
    protected $fillable = [
        // 'place_id',
        'rooms',
        'beds',
        'bathrooms',
        'm2',
        'description'
    ];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
