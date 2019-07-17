<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends MainModel
{
    protected $primaryKey="id";
    protected $fillable = [
        'owner_id', 'guest_id'
    ];
    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }
    public function guest(){
        return $this->belongsTo(User::class,'guest_id','id');
    }
    public function message(){
        return $this->belongsTo(Chat::class);
    }
}
