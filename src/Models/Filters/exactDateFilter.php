<?php

namespace Thienhungho\Modules\CoreBase\Models\Filters;

use Exception;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class exactDateFilter implements Filter
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
                $columnDataAfterExtract = $this->buildWhereQuery($columnData);
                $query->whereDate($columnDataAfterExtract['column'], $columnDataAfterExtract['value']);
            }
        } else {
            $columnDataAfterExtract = $this->buildWhereQuery($value);
            $query->whereDate($columnDataAfterExtract['column'], $columnDataAfterExtract['value']);
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
        $value = $array[1];
        if (in_array($column, $this->allowedFields)) {
            return ['column' => $column, 'value' => Carbon::parse($value)];
        } else {
            throw new Exception($column . ' ' . __('field is not allowed'));
        }
    }
}
