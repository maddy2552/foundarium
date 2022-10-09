<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="EntityDeletedResponse",
 *     description="Entity deleted response",
 *     @OA\Xml(
 *         name="EntityDeletedResponse"
 *     )
 * )
 */
class EntityDeletedResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Success",
     *     description="Entity deleted message",
     *     example="Entity successfully deleted."
     * )
     *
     * @var string
     */
    public string $success;
}
