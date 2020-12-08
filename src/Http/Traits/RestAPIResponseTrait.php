<?php

namespace Thienhungho\Modules\CoreBase\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

trait RestAPIResponseTrait
{
    /**
     * @param array $data
     * @param int|int $httpStatusCode
     * @return JsonResponse
     */
    public function sendCustomJsonResponse(array $data = [], $httpStatusCode = Response::HTTP_OK)
    {
        return response()->json($data, $httpStatusCode);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function sendOkResponse(array $data = [])
    {
        return $this->sendCustomJsonResponse(array_merge([
            'status' => true,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('Success')
        ], $data), Response::HTTP_OK);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function sendValidationFailedResponse(array $data = [])
    {
        return $this->sendCustomJsonResponse(array_merge([
            'status' => false,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('The given data was invalid.')
        ], $data), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function sendInternalServerErrorResponse(array $data = [])
    {
        return $this->sendCustomJsonResponse(array_merge([
            'status' => false,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('Internal Server Error.')
        ], $data), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function sendUnAuthorizedResponse(array $data = [])
    {
        return $this->sendCustomJsonResponse(array_merge([
            'status' => false,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('Unauthorized')
        ], $data), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function sendDestroySuccessResponse(array $data = [])
    {
        return $this->sendCustomJsonResponse(array_merge([
            'status' => true,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('Deleted Success')
        ], $data), Response::HTTP_OK);
    }

    /**
     * @param JsonResource $resource
     * @param array $anotherData
     * @return JsonResponse
     */
    public function sendResourceResponse(JsonResource $resource, array $anotherData = [])
    {
        return $this->sendCustomJsonResponse(
            array_merge(
                [
                    'status' => true,
                    "code" => 0,
                    "locale" => app()->getLocale(),
                    'message' => __('Success')
                ],
                $resource->toResponse(app('Request'))->getData(true),
                $anotherData
            ),
            Response::HTTP_OK
        );
    }

    /**
     * @param JsonResource $resource
     * @return JsonResponse
     */
    public function sendCreatedResourceResponse(JsonResource $resource)
    {
        $data = $resource->toResponse(app('Request'))->getData(true);

        return $this->sendCustomJsonResponse(array_merge([
            'status' => true,
            "code" => 0,
            "locale" => app()->getLocale(),
            'message' => __('Success')
        ], $data), Response::HTTP_CREATED);
    }

    /**
     * @param JsonResource $resource
     * @param array $anotherData
     * @return JsonResponse
     */
    public function sendUpdatedResourceResponse(JsonResource $resource, array $anotherData = [])
    {
        $data = $resource->toResponse(app('Request'))->getData(true);

        return $this->sendCustomJsonResponse(
            array_merge(
                [
                    'status' => true,
                    "code" => 0,
                    "locale" => app()->getLocale(),
                    'message' => __('Success')
                ],
                $data,
                $anotherData
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * @param ResourceCollection $resourceCollection
     * @param array $anotherData
     * @return JsonResponse
     */
    public function sendListItemResponse(ResourceCollection $resourceCollection, array $anotherData = [])
    {
        return $this->sendCustomJsonResponse(
            array_merge(
                [
                    'status' => true,
                    "code" => 0,
                    "locale" => app()->getLocale(),
                    'message' => __('Success')
                ],
                $resourceCollection->toResponse(app('Request'))->getData(true),
                $anotherData
            ),
            Response::HTTP_OK
        );
    }
}
