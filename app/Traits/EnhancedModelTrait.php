<?php namespace App\Traits;

trait EnhancedModelTrait {
    
    public static function search($filters = [], $fields = ['*'], $withs = []){
        $query = self::query();

        foreach($filters as $filter){
            if(is_array($filter) && count($filter) >= 3)
                $query->where($filter[0], $filter[1], $filter[2]);
            else if(is_array($filter) && count($filter) == 2)
                $query->where($filter[0], $filter[1]);
        }

        if(count($withs) > 0)
            $query->with($withs);

        return $query->select($fields);
    }
}