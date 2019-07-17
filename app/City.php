<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends MainModel
{
    protected $fillable = [
        'id','name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $primaryKey = 'id'; // or null
}
