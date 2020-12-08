<?php

namespace Thienhungho\Modules\CoreBase\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Thienhungho\Modules\CoreBase\Models\QueryBuilders\AbstractQueryBuilder;

/**
 * Class AbstractService
 * @package Thienhungho\Modules\CoreBase\Services
 */
class AbstractService
{
    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var AbstractQueryBuilder
     */
    protected $queryBuilder;

    /**
     * @return mixed
     */
    public function all()
    {
        return app($this->modelClass)::all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        return app($this->modelClass)::create($attributes);
    }

    /**
     * @param $where
     * @return Builder|Model|object|null
     */
    public function findOneWhere($where)
    {
        return app($this->modelClass)::where($where)->first();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($data)
    {
        return app($this->modelClass)->updateOrCreate($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOneById(int $id)
    {
        return app($this->modelClass)::findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Throwable
     */
    public function destroy($id)
    {
        $model = $this->findOneById($id);

        return DB::transaction(function () use ($model) {
            return $model->delete();
        });
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     * @throws \Throwable
     */
    public function update($id, array $attributes)
    {
        $model = $this->findOneById($id);

        return DB::transaction(function () use ($model, $attributes) {
            $model->update($attributes);

            return $model;
        });
    }

    /**
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return app($this->modelClass)::firstOrCreate($data);
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function indexData($data = [])
    {
        $initialData = [
            'per_page' => \Request::get('per_page', 10),
            'page' => \Request::get('page', 1),
            'columns' => \Request::get('columns', '*'),
            'page_name' => \Request::get('page_name', 'page'),
        ];

        $data = array_merge($initialData, $data);

        return $this->queryBuilder::initialQuery()
            ->paginate($data['per_page'], $data['columns'], $data['page_name'], $data['page']);
    }

    /**
     * @return mixed
     */
    public function allWithFilter()
    {
        return $this->queryBuilder::initialQuery()->get();
    }
}
