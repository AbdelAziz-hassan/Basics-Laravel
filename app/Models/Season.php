<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    //
    use SoftDeletes;

    public $table = 'seasons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'slug',
        'duration',
        'description',
        'release_date',
        'rate',
        'episodes_numbers',
        'title_id',
        'picture',
    ];

    public function series(){
        return $this->belongsTo(\App\Models\Title::class,'title_id');
    }
    public function episodes(){
        return $this->hasMany(\App\Models\Episode::class);
    }
    public function reviews()
    {
        return $this->morphMany('App\Models\Reveiw', 'reviewable');
    }
    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }
}
