<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    const TYPE_GUEST = 1;
    const TYPE_OWNER= 2;

    const STATUS_REGISTERED =1;
    const STATUS_INACTIVE =2;
    const STATUS_BANNED =3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $keyType = 'string';

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    public function properties(){
        return $this->hasMany(Property::class,'user_id');
    }
    public function review(){
        return $this->hasMany(Review::class,'property_id');
    }
    public function transactionPremium(){
        return $this->hasOne(Transaction::class);
    }
    public function favorite(){
        return $this->hasMany(Favorite::class);
    }
    public function follower(){
        return $this->hasMany(Follow::class,'to_id','id');
    }
    public function following(){
        return $this->hasMany(Follow::class,'from_id','id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getFollowerAttribute(){
        return Follow::where('to_id',$this->id)->get();
    }
    public function getPremiumAttribute(){
        return Transaction::where('user_id',$this->id)->where('premium_status',1)->get();
    }
    protected $appends = ['follower','premium'];

    public function getFavoriteAttribute()
    {
        return Favorite::where('user_id', $this->id)->paginate(10);
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
