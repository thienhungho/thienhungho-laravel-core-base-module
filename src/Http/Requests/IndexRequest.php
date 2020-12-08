<?php

namespace Thienhungho\Modules\CoreBase\Http\Requests;


class IndexRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => 'integer|min:1|max:100',
            'page' => 'integer|min:1',
            'columns' => '*',
            'page_Name' => 'string',
            'order_by' => 'string',
            'sorted_by' => 'string|in:ASC,asc,DESC,desc'
        ];
    }
}
