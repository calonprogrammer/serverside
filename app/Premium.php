<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Premium extends MainModel
{
    use SoftDeletes;
    protected $fillable = [
        'id','name', 'discount', 'duration',
    ];
    protected $table = 'premiums';
    protected $primaryKey = 'id';
}
