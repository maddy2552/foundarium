<?php

namespace App\OpenApi\Responses\General;

/**
 * @OA\Schema(
 *     title="UnprocessableContentResponse",
 *     description="Unprocessable content response",
 *     @OA\Xml(
 *         name="UnprocessableContentResponse"
 *     )
 * )
 */
class UnprocessableContentResponse
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Message",
     *     description="Message describing error",
     *     example="The field must be an integer."
     * )
     *
     * @var string
     */
    public string $message;

    /**
     * @OA\Property(ref="#/components/schemas/ValidationErrors")
     *
     * @var object
     */
    public object $errors;
}
