<?php

namespace Thienhungho\Modules\CoreBase\Models\Filters;

use Exception;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GreaterThanFilter implements Filter
{
    public $allowedFields;

    /**
     * GreaterThanFilter constructor.
     * @param $allowedFields
     */
    public function __construct($allowedFields)
    {
        $this->allowedFields = $allowedFields;
    }

    /**
     * @param Builder $query
     * @param $value
     * @param string $property
     * @throws Exception
     */
    public function __invoke(Builder $query, $value, string $property)
    {
        $whereData = [];
        if (is_array($value)) {
            foreach ($value as $column => $data) {
                if (in_array($column, $this->allowedFields)) {
                    $whereData[] = [$column, '>=', $value];
                } else {
                    throw new Exception($column . ' ' . __('field is not allowed'));
                }
            }
        }

        $query->where($whereData);
    }
}
