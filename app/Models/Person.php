<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;
class Person extends Model
{
    //
    use SoftDeletes;
    use Filterable;
    public $table = 'persons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
   
    public $fillable = [
        'name',
        'last_name',
        'slug',
        'birth_date',
        'birth_place',
        'info',
        'picture',
    ];

    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }
    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }
    public function titles()
    {
        return $this->belongsToMany('App\Models\Title','casts')->withPivot('character_id','role_id');
    }
    public function casts(){
        return $this->hasMany('App\Models\Cast')->with('title');
    }

}
