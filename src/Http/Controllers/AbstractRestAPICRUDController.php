<?php

namespace Thienhungho\Modules\CoreBase\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Thienhungho\Modules\CoreBase\Http\Traits\RestAPIResponseTrait;
use Thienhungho\Modules\CoreBase\Services\AbstractService;
use Throwable;

abstract class AbstractRestAPICRUDController extends AbstractController
{
    use RestAPIResponseTrait;

    /**
     * @var AbstractService
     */
    protected $service;

    /**
     * @var string
     */
    protected $jsonResource;

    /**
     * @var string
     */
    protected $storeRequest;

    /**
     * @var string
     */
    protected $updateRequest;

    /**
     * @var string
     */
    protected $jsonResourceCollection;

    /**
     * @var string
     */
    protected $indexRequest;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        app($this->indexRequest);

        return $this->sendListItemResponse(
            app($this->jsonResourceCollection, [
                'resource' => $this->service->indexData()
            ])
        );
    }

    /**
     * @return JsonResponse
     */
    public function store()
    {
        $request = app($this->storeRequest);

        return $this->sendCreatedResourceResponse(
            app($this->jsonResource, [
                'resource' => $this->service->create($request->all())
            ])
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update($id)
    {
        $request = app($this->updateRequest);

        return $this->sendUpdatedResourceResponse(
            app($this->jsonResource, [
                'resource' => $this->service->update($id, $request->all())
            ])
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->sendResourceResponse(
            app($this->jsonResource, [
                'resource' => $this->service->findOneById($id)
            ])
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy($id)
    {
        $this->service->destroy($id);

        return $this->sendDestroySuccessResponse();
    }
}
