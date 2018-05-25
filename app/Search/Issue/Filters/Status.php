<?php

namespace App\Search\Issue\Filters;


use Illuminate\Database\Eloquent\Builder;

class Status
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @param bool $whereIn
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereHas('status', function (Builder $q) use ($value) {
            $q->where('status.name', $value);
        });
    }
}