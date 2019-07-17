<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends MainModel
{
    protected $fillable = [
        'id','property_id','user_id','content',
    ];
    protected $primaryKey = 'id';
    public function commentable(){
        return $this->morphTo();
    }
    public function comment(){
        return $this->morphMany(Comment::class,'commentable',null,'parent_id','id');
    }
}
