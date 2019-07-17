<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $primaryKey="id";
    protected $fillable = [
        'id', 'message','status','channel_id','sent_time','sender','receiver'
    ];
    public function channel(){
        return $this->belongsTo(Chat::class,'channel_id');
    }
}
