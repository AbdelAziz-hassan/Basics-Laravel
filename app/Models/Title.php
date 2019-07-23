<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Title extends Model
{
    //
    use SoftDeletes;
    use Filterable;
    
    public $table = 'titles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'duration',
        'type',
        'description',
        'release_date',
        'rate',
        'picture',
    ];

    public function seasons(){
        return $this->hasMany(\App\Models\Season::class);
    }
    public function keywords(){
        return $this->belongsToMany(\App\Models\KeyWord::class,'keyword_title','title_id','keyword_id');
    }
    public function groups(){
        return $this->belongsToMany(\App\Models\Group::class);
    }
    public function categories(){
        return $this->belongsToMany(\App\Models\Category::class);
    }
    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }
    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }
    public function persons()
    {
        return $this->belongsToMany('App\Models\Person','casts')->withPivot('character_id','role_id');
    }
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character','casts')->withPivot('person_id','role_id');
    }
    public function casts(){
        return $this->hasMany('App\Models\Cast');
    }
    protected $appends = ['year'];
    public function getYearAttribute(){
        return \Carbon\Carbon::parse($this->release_date)->format('Y');
    }
    public function writers(){
        return $this->casts()->whereHas('role',function($q){
            $q->where('role', 'Writer');
        })->with('person','character');
    }
    public function directors(){
        return $this->casts()->whereHas('role',function($q){
            $q->where('role', 'Director');
        })->with('person','character');
    }
    public function stars(){
        return $this->casts()->whereHas('role',function($q){
            $q->where([['role','!=', 'Writer'],['role','!=','Director']]);
        })->with('person','character');
    }

    public function scopeSeries($query)
    {
        return $query->where('type', 'series');
    }
    public function scopeMovies($query)
    {
        return $query->where('type', 'movie');
    }
}
