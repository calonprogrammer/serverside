<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends MainModel
{
    protected $fillable = [
        'id','room_remaining', 'gender_type',
    ];
    protected $keyType = 'string';

    public function propertiable(){
        return $this->morphOne('App\Property','propertiable');
    }
}
