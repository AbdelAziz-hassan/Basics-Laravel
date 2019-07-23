<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PersonFilter extends ModelFilter
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
    public function lastName($last_name)
    {
        return $this->where(function($q) use ($last_name)
        {
            return $q->where('last_name', 'LIKE', "%$last_name%");
        });
    }
    public function birthDate($birth_date)
    {
        return $this->where(function($q) use ($birth_date)
        {
            return $q->where('birth_date','<',$birth_date);
        });
    }

}
