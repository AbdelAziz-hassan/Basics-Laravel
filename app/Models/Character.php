<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Character extends Model
{
    //
    use SoftDeletes;
    use Filterable;

    public $table = 'characters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
   
    public $fillable = [
        'name',
        'last_name',
        'slug',
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
    public function casts(){
        return $this->hasOne('App\Models\Cast');
    }
}
