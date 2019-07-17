<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends MainModel
{
    protected $fillable = [
        'id','user_id','property_id',
    ];
    protected $primaryKey = 'id';
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
