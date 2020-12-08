<?php

namespace Thienhungho\Modules\CoreBase\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            new JsonResponse(
                [
                    'status' => false,
                    "code" => 0,
                    "locale" => app()->getLocale(),
                    'message' => __("The given data was invalid."),
                    'errors' => $validator->getMessageBag()->toArray()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
