<?php

namespace Thienhungho\Modules\CoreBase\Converters;

abstract class AbstractConverter
{
    /**
     * @param $apiResourceClass
     * @param $eloquentModel
     * @return mixed
     */
    public static function convertEloquentModelToAPIResourceResponseData($apiResourceClass, $eloquentModel)
    {
        return app($apiResourceClass, ['resource' => $eloquentModel])
            ->toResponse(app('Request'))
            ->getData(true);
    }
}
