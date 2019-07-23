<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cast extends Model
{
    //
    use SoftDeletes;

    public $table = 'casts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'title_id',
        'role_id',
        'person_id',
        'character_id',
    ];

    public function title(){
        return $this->belongsTo(\App\Models\Title::class);
    }
    public function person(){
        return $this->belongsTo(\App\Models\Person::class);
    }
    public function role(){
        return $this->belongsTo(\App\Models\Role::class);
    }
    public function character(){
        return $this->belongsTo(\App\Models\Character::class);
    }
}
