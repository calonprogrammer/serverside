<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends MainModel
{
    protected $fillable = [
        'id','title', 'content','role_id'
    ];
    protected $primaryKey = 'id';

    public function tags(){
        return $this->belongsToMany(Tag::class,'detail_post','post_id');
    }
}
