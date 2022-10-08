<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="EntityNotFoundResponse",
 *     description="Entity not found response",
 *     @OA\Xml(
 *         name="EntityNotFoundResponse"
 *     )
 * )
 */
class EntityNotFoundResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Error",
     *     description="Entity not found message",
     *     example="Entity not found."
     * )
     *
     * @var string
     */
    public string $error;
}
