<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     title="ValidationErrors",
 *     description="Validation errors",
 *     @OA\Xml(
 *         name="ValidationErrors"
 *     )
 * )
 */
class ValidationErrors
{
    /**
     * @OA\Property(
     *     title="Id",
     *     description="Name of the input field failed validation with array of errors",
     *     format="array",
     *     @OA\Items(ref="#/components/schemas/StringError")
     * )
     *
     * @var array
     */
    public array $id;
}
