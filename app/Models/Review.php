<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;

    public $table = 'reviews';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
   
    public $fillable = [
        'reviewable_id',
        'reviewable_type',
        'review',
        'rate',
        'created_by',
    ];

    public function user(){
        return $this->belongsTo(\App\User::class,'created_by');
    }
    public function reviewable()
    {
        return $this->morphTo();
    }
    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }
}
