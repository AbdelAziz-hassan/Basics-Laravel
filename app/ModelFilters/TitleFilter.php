<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TitleFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    public function title($title)
    {
        return $this->where(function($q) use ($title)
        {
            return $q->where('title', 'LIKE', "%$title%");
        });
    }
    public function type($type)
    {
        return $this->where(function($q) use ($type)
        {
            return $q->where('type',$type);
        });
    }
    public function releaseDate($release_date)
    {
        return $this->where(function($q) use ($release_date)
        {
            return $q->where('release_date','<',$release_date);
        });
    }
    public function categoryIds($category_ids)
    {
      
        return $this->whereHas('categories',function ($q) use ($category_ids)
        {
            return $q->whereIn('category_id', $category_ids);
        });
        
    }
    public function category($category){
        
        return $this->whereHas('categories',function ($q) use ($category)
        {
            return $q->where('category_id', $category);
        });
    }
    public function sort($sort){
        return $this->orderBy($sort,'desc');
    }
}
