<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainModel extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
}
