<?php

namespace App\OpenApi\Responses;

/**
 * @OA\Schema(
 *     title="UserResponse",
 *     description="User Response",
 *     @OA\Xml(
 *         name="UserResponse"
 *     )
 * )
 */
class UserResponse
{
    /**
     * @OA\Property(ref="#/components/schemas/UserWithVehicle")
     *
     * @var object
     */
    private object $data;
}
