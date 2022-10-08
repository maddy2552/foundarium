<?php

namespace App\OpenApi\Models;

use Carbon\Carbon;

/**
 * @OA\Schema(
 *     title="Vehicle",
 *     description="Vehicle model",
 *     @OA\Xml(
 *         name="Vehicle"
 *     )
 * )
 */
class Vehicle
{
    /**
     * @OA\Property(
     *     format="int",
     *     type="int64",
     *     title="Id",
     *     description="Id of the vehicle",
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
     *     title="Name",
     *     description="Name of the vehicle",
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
     *     description="Vin number of the vehicle",
     *     example="4Y1SL65848Z411439"
     * )
     *
     * @var string
     */
    public string $vin;

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
