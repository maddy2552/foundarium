<?php

namespace App\OpenApi\Requests;

/**
 * @OA\Schema(
 *     title="CreateOrUpdateUserRequest",
 *     description="Create/Update User request body data",
 *     type="object",
 *     required={"first_name","last_name", "vehicle_id"},
 *     @OA\Xml(
 *        name="CreateOrUpdateUserRequest"
 *    )
 * )
 */
class CreateOrUpdateUserRequest
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="First name",
     *     description="First name of the user",
     *     minLength=2,
     *     maxLength=255,
     *     example="Kirill"
     * )
     *
     * @var string
     */
    public string $first_name;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Last name",
     *     description="Last name of the user",
     *     minLength=2,
     *     maxLength=255,
     *     example="Kushnaryov"
     * )
     *
     * @var string
     */
    public string $last_name;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="Vehicle id",
     *     description="Vehicle id. Must exist in database. Can be null",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $vehicle_id;
}
