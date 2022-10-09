<?php

namespace App\Exceptions\Api;

use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Exception;

class UserAlreadyHasVehicle extends Exception
{
    use ApiResponseHelpers;

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->respondError(__('api.user.has-vehicle'));
    }
}
