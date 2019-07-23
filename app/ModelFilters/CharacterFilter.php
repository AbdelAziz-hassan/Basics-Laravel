<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class CharacterFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    public function name($name)
    {
        return $this->where(function($q) use ($name)
        {
            return $q->where('name', 'LIKE', "%$name%");
        });
    }
    public function person($person)
    {
        return  $this->related('casts', function($query) use ($person) {
            $persons = \App\Models\Person::where('name','LIKE',"%$person%")->pluck('id')->toArray();
            return $query->whereIn('person_id', $persons);
        });
    }
    public function title($title)
    {
        return  $this->related('casts', function($query) use ($title) {
            $titles = \App\Models\Title::where('title','LIKE',"%$title%")->pluck('id')->toArray();
            return $query->whereIn('title_id', $titles);
        });
    }

}
