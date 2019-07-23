<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    //
    use SoftDeletes;

    public $table = 'episodes';
    
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
        'season_id',
        'picture',
    ];

    public function season(){
        return $this->belongsTo(\App\Models\Season::class);
    }
    public function reviews()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }
    public function files()
    {
        return $this->morphToMany('App\Models\File', 'fileable');
    }
    protected $appends=['rate'];
    public function getRateAttribute(){
        $rate_count = count($this->reviews()->pluck('rate'));
        if($rate_count>0){
            $rate = array_sum($this->reviews()->pluck('rate')->toArray())/$rate_count;
        }
        else
            $rate=0;

        return $rate;
    }
}
