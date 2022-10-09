<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="InternalServerErrorResponse",
 *     description="Internal server error reponse",
 *     @OA\Xml(
 *         name="InternalServerErrorResponse"
 *     )
 * )
 */
class InternalServerErrorResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Message",
     *     description="Internal Server Error message",
     *     example="Server error"
     * )
     *
     * @var string
     */
    public string $message;
}
