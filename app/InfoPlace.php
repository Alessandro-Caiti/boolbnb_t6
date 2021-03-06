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
    protected $primaryKey = 'place_id';

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
