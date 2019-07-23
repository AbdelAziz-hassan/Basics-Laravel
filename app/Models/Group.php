<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    //
    use SoftDeletes;

    public $table = 'groups';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
    ];

    public function users(){
        return $this->belongsToMany(\App\User::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($group) { // before delete() method call this
             $group->users()->sync([]);
             // do the rest of the cleanup...
        });
    }
}
