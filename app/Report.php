<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends MainModel
{
    use SoftDeletes;

    protected $fillable = [
        'id','user_id', 'property_id',
    ];

    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function property(){
        return $this->belongsTo(Property::class);
    }

}