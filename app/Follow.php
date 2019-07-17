<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends MainModel
{
    protected $fillable = [
        'id','slug', 'to_id',
    ];
    protected $primaryKey = 'id';

    public function follower(){
        return $this->hasOne(User::class,'id','to_id');
    }

    public function userFrom(){
        return $this->hasOne(User::class , 'id','from_id');
    }

}
