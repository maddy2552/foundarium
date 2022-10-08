<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="VehicleAlreadyHasUserResponse",
 *     description="Vehicle already has user response",
 *     @OA\Xml(
 *         name="VehicleAlreadyHasUserResponse"
 *     )
 * )
 */
class VehicleAlreadyHasUserResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Error",
     *     description="Message describing error",
     *     example="The specified vehicle already has a user."
     * )
     *
     * @var string
     */
    public string $error;
}
