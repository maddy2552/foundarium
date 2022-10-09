<?php

namespace App\Exceptions\Api;

use Exception;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;

class VehicleAlreadyHasUser extends Exception
{
    use ApiResponseHelpers;

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->respondError(__('api.vehicle.has-user'));
    }
}
