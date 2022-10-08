<?php

namespace App\OpenApi\Responses;

/**
 * @OA\Schema(
 *     title="VehiclePaginatedResponse",
 *     description="Vehicle Paginated Response",
 *     @OA\Xml(
 *         name="VehiclePaginatedResponse"
 *     )
 * )
 */
class VehiclePaginatedResponse
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data",
     *     format="array",
     *     @OA\Items(ref="#/components/schemas/VehicleWithUser")
     * )
     *
     * @var array
     */
    public array $data;

    /**
     * @OA\Property(ref="#/components/schemas/PaginationLinks")
     *
     * @var object
     */
    public object $links;

    /**
     * @OA\Property(ref="#/components/schemas/PaginationMeta")
     *
     * @var object
     */
    public object $meta;
}
