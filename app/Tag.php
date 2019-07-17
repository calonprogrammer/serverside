<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends MainModel
{
    protected $fillable = [
        'id','slug', 'name'
    ];
    protected $primaryKey = 'id';
    
}
