<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="UserAlreadyHasVehicleResponse",
 *     description="User already has vehicle response",
 *     @OA\Xml(
 *         name="UserAlreadyHasVehicleResponse"
 *     )
 * )
 */
class UserAlreadyHasVehicleResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Error",
     *     description="Message describing error",
     *     example="The specified user already has a vehicle."
     * )
     *
     * @var string
     */
    public string $error;
}
