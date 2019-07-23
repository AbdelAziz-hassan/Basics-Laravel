<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','picture','slug'
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];
    public function hasGroup($group='')
    {
        return $this->groups->contains('name',$group);
    }
    public function groups()
    {
        return $this->belongsToMany(\App\Models\Group::class);
    }
    public function assignGroup(\App\Models\Group $group)
    {
        return $this->groups()->save($group);
    }
    public function reviews(){
        return $this->hasMany(\App\Models\Review::class,'created_by');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
             $user->reviews()->delete();
             // do the rest of the cleanup...
        });
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }    
}
