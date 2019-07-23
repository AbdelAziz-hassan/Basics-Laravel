<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyWord extends Model
{
    //
    use SoftDeletes;

    public $table = 'keywords';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'keyword',
    ];

    public function title(){
        return $this->belongsToMany(\App\Models\Title::class);
    }
}
