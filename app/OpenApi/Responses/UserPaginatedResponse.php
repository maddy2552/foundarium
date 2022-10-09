<?php

namespace App\OpenApi\Responses;

/**
 * @OA\Schema(
 *     title="UserPaginatedResponse",
 *     description="User Paginated Response",
 *     @OA\Xml(
 *         name="UserPaginatedResponse"
 *     )
 * )
 */
class UserPaginatedResponse
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data",
     *     format="array",
     *     @OA\Items(ref="#/components/schemas/UserWithVehicle")
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
