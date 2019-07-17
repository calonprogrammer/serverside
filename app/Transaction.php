<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends MainModel
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'premium_id', 'start_date', 'end_date', 'premium_status'
    ];
    protected $keyType = 'string';
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function premium(){
        return $this->hasOne(Premium::class,'id','premium_id');
    }
}
