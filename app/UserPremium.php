<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPremium extends MainModel
{
    protected $fillable = [
        'id','user_id', 'premium_id', 'start_date','end_date'
    ];
    protected $primaryKey = 'id';
    protected $table = 'premiums';
}
