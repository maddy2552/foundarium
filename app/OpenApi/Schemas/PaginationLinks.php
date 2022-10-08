<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     title="PaginationLinks",
 *     description="Pagination links",
 *     @OA\Xml(
 *         name="PaginationLinks"
 *     )
 * )
 */
class PaginationLinks
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="First",
     *     description="Link for first page",
     *     example="http://localhost/api/v1/users?page=1"
     * )
     *
     * @var string
     */
    public string $first;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Last",
     *     description="Link for last page",
     *     example="http://localhost/api/v1/users?page=17"
     * )
     *
     * @var string
     */
    public string $last;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Prev",
     *     description="Link for previous page",
     *     example="http://localhost/api/v1/users?page=2"
     * )
     *
     * @var string
     */
    public string $prev;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Next",
     *     description="Link for next page",
     *     example="http://localhost/api/v1/users?page=3"
     * )
     *
     * @var string
     */
    public string $next;
}
