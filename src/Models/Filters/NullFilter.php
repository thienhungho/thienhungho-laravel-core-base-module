<?php

namespace Thienhungho\Modules\CoreBase\Models\Filters;

use Exception;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class NullFilter implements Filter
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
            foreach ($value as $column) {
                if (in_array($column, $this->allowedFields)) {
                    $query->whereNull($column);
                } else {
                    throw new Exception($column . ' ' . __('field is not allowed'));
                }
            }
        } else {
            if (in_array($value, $this->allowedFields)) {
                $query->whereNull($value);
            } else {
                throw new Exception($value . ' ' . __('field is not allowed'));
            }
        }
    }
}
