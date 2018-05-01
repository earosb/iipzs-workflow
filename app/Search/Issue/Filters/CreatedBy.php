<?php

namespace App\Search\Issue\Filters;


use Illuminate\Database\Eloquent\Builder;

class CreatedBy
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('created_by', $value);
    }
}