<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartement extends MainModel
{

    protected $fillable = [
        'id','name', 'furnished','unit_type','unit_floor'
    ];

    protected $primaryKey = 'id';
    public function propertiable(){
        return $this->morphOne('App\Property','propertiable');
    }
}
