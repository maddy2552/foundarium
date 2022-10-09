<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     title="PaginationMeta",
 *     description="Pagination meta information",
 *     @OA\Xml(
 *         name="PaginationMeta"
 *     )
 * )
 */
class PaginationMeta
{
    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="Current page",
     *     description="Current page",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $current_page;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="From",
     *     description="From",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $from;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="Last page",
     *     description="Last page",
     *     example="17"
     * )
     *
     * @var int
     */
    public int $last_page;

    /**
     * @OA\Property(
     *     title="Links",
     *     description="Pagination links objects",
     *     format="array",
     *     @OA\Items(ref="#/components/schemas/PaginationLink")
     * )
     *
     * @var array
     */
    public array $links;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Path",
     *     description="API path",
     *     example="http://localhost/api/v1/users"
     * )
     *
     * @var string
     */
    public string $path;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="Per page",
     *     description="Items per page",
     *     example="15"
     * )
     *
     * @var int
     */
    public int $per_page;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="To",
     *     description="To",
     *     example="45"
     * )
     *
     * @var int
     */
    public int $to;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="Total",
     *     description="Total count of entities",
     *     example="200"
     * )
     *
     * @var int
     */
    public int $total;
}
