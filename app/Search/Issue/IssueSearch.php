<?php

namespace App\Search\Issue;

use App\Issue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IssueSearch
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new Issue())->newQuery());
        
        return static::getResults($query);
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            
            $decorator = static::createFilterDecorator($filterName);
            
            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
            
        }
        return $query;
    }
    
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . studly_case($name);
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
    
    private static function getResults(Builder $query)
    {
        return $query->withCount('comments')->orderBy('updated_at', 'desc')->paginate(20);
    }
}