<?php

namespace App\OpenApi\Requests;

/**
 * @OA\Schema(
 *     title="CreateOrUpdateVehicleRequest",
 *     description="Create/Update Vehicle request body data",
 *     type="object",
 *     required={"name","vin", "user_id"},
 *     @OA\Xml(
 *        name="CreateOrUpdateVehicleRequest"
 *    )
 * )
 */
class CreateOrUpdateVehicleRequest
{
    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Name",
     *     description="Name of the vehicle",
     *     minLength=2,
     *     maxLength=255,
     *     example="BMW"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="Vin",
     *     description="VIN number of the vehicle. Unique",
     *     minLength=2,
     *     maxLength=255,
     *     example="4Y1SL65848Z411439"
     * )
     *
     * @var string
     */
    public string $vin;

    /**
     * @OA\Property(
     *     format="int",
     *     type="int",
     *     title="User id",
     *     description="Vehicle id. Must exist in database. Can be null",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $user_id;
}
