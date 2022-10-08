<?php

namespace App\OpenApi\Responses;

/**
 * @OA\Schema(
 *     title="VehicleResponse",
 *     description="Vehicle Response",
 *     @OA\Xml(
 *         name="VehicleResponse"
 *     )
 * )
 */
class VehicleResponse
{
    /**
     * @OA\Property(ref="#/components/schemas/VehicleWithUser")
     *
     * @var object
     */
    private object $data;
}
