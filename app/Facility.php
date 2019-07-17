<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends MainModel
{
    use SoftDeletes;
    const TYPE_UNIT= 1;
    const TYPE_PUBLIC= 2;
    const TYPE_PARKING = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'link', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $primaryKey = 'id'; // or null

    public function property(){
        return $this->belongsToMany(Property::class,'property_facilities_pivot','facility_id');
    }
}
