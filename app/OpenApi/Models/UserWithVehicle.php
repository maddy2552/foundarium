<?php

namespace App\OpenApi\Models;

use Carbon\Carbon;

/**
 * @OA\Schema(
 *     title="UserWithVehicle",
 *     description="User model with Vehicle",
 *     @OA\Xml(
 *         name="UserWithVehicle"
 *     )
 * )
 */
class UserWithVehicle
{
    /**
     * @OA\Property(
     *     format="int",
     *     type="int64",
     *     title="Id",
     *     description="Id of the user",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     type="string",
     *     title="First name",
     *     description="First name of the user",
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
     *     example="Kushnaryov"
     * )
     *
     * @var string
     */
    public string $last_name;

    /**
     * @OA\Property(ref="#/components/schemas/Vehicle")
     *
     * @var Vehicle
     */
    public Vehicle $vehicle;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2022-10-04T20:27:20.000000Z",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var Carbon
     */
    public Carbon $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2022-10-04T20:27:20.000000Z",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var Carbon
     */
    public Carbon $updated_at;
}
