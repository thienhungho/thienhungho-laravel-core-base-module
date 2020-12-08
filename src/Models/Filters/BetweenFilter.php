<?php

namespace Thienhungho\Modules\CoreBase\Models\Filters;

use Exception;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BetweenFilter implements Filter
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
        if (is_array($value)) {
            foreach ($value as $columnData) {
                $queryData = $this->buildWhereQuery($columnData);
                $query->whereBetween($queryData['column'], $queryData['values']);
            }
        } else {
            $queryData = $this->buildWhereQuery($value);
            $query->whereBetween($queryData['column'], $queryData['values']);
        }
    }

    /**
     * @param $columnData
     * @return array
     * @throws Exception
     */
    protected function buildWhereQuery($columnData)
    {
        $array = explode('|', $columnData);
        $column = $array[0];
        $valueData = $array[1];
        $values = explode('>', $valueData);
        if (in_array($column, $this->allowedFields)) {
            return ['column' => $column, 'values' => $values];
        } else {
            throw new Exception($column . ' ' . __('field is not allowed'));
        }
    }
}
