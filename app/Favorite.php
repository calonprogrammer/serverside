<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends MainModel
{
    use SoftDeletes;
    protected $fillable = [
        'id','user_id', 'property_id', 'liked',
    ];
    protected $primaryKey = 'id';

//    public function property(){
//        return $this->hasOne(Property::class,'id','property_id');
//    }
    public function getPropertyAttribute(){
        return Property::with(['propertiable','city'])->where('id',$this->property_id)->first();
    }
    protected $appends = ['property'];


}
