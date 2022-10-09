<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     title="PaginationLink",
 *     description="Pagination link object",
 *     @OA\Xml(
 *         name="PaginationLink"
 *     )
 * )
 */
class PaginationLink
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Url",
     *     description="Page url",
     *     example="http://localhost/api/v1/users?page=1"
     * )
     *
     * @var string
     */
    public string $url;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Url",
     *     description="Page label",
     *     example="1"
     * )
     *
     * @var string
     */
    public string $label;

    /**
     * @OA\Property(
     *     format="bool",
     *     type="bool",
     *     title="Active",
     *     description="Determines is current page active",
     *     example="true"
     * )
     *
     * @var bool
     */
    public bool $active;
}
