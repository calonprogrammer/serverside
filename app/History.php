<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends MainModel
{
    protected $fillable = [
        'id','user_id','property_id',
    ];
    protected $keyType = 'string';
   public function property(){
       return $this->hasOne(Property::class,'id','property_id');
   }
}
