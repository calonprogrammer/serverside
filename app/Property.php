<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends MainModel
{
    protected $fillable = [
        'id','user_id','name', 'description', 'area', 'price','period','city_id','longitude','latitude','address',
    ];
    protected $primaryKey = 'id';


    public function propertiable(){
        return $this->morphTo();
    }
    public function facility(){
       return $this->belongsToMany(Facility::class,'property_facilities_pivot','property_id');
    }
    public function apartement(){
        return $this->hasOne(Apartement::class,'id','id');
    }
    public function house(){
        return $this->hasOne(House::class,'id','id');
    }
    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function review(){
        return $this->hasMany(Review::class,'property_id','id');
    }
    public function favorite(){
        return $this->hasMany(Favorite::class);
    }
}
