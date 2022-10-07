<?php

namespace App\Exceptions\Api;

use Exception;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;

class EntityNotFoundException extends Exception
{
    use ApiResponseHelpers;

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->respondNotFound(__('api.entity.not-found'));
    }
}
