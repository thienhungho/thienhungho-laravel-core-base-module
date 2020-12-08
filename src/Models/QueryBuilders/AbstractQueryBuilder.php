<?php

namespace Thienhungho\Modules\CoreBase\Models\QueryBuilders;

use Illuminate\Database\Query\Builder;
use Spatie\QueryBuilder\QueryBuilder;

abstract class AbstractQueryBuilder extends QueryBuilder
{
    /**
     * @return mixed
     */
    abstract public static function baseQuery();

    /**
     * @return mixed
     */
    abstract public static function initialData();

    /**
     * @return Builder|QueryBuilder|AbstractQueryBuilder
     */
    public static function initialQuery()
    {
        $initialData = static::initialData();

        return static::for(static::baseQuery())
            ->allowedFields($initialData['allowedFields'])
            ->defaultSort($initialData['defaultSort'])
            ->allowedSorts($initialData['allowedSorts'])
            ->allowedFilters($initialData['allowedFilters'])
            ->allowedIncludes($initialData['allowedIncludes']);
    }
}
