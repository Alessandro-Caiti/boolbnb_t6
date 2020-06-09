<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'place_id',
        'mail',
        'message'
    ];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
