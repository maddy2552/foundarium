<?php

namespace App\OpenApi\Controllers;

/**
 * @OA\Get(
 *     path="/vehicles/{id}",
 *     operationId="getVehicleById",
 *     tags={"Vehicles"},
 *     summary="Get vehicle information",
 *     description="Returns vehicle data",
 *     @OA\Parameter(
 *         name="id",
 *         description="Vehicle id",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer",
 *             example="1"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfull operation",
 *         @OA\JsonContent(ref="#/components/schemas/VehicleResponse")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(ref="#/components/schemas/EntityNotFoundResponse")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content. <br/> Contains 'message' key with first error message and 'errors' key object with keys - fields failed validation and arrays - value with errors",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *     ),
 * ),
 *
 * @OA\Delete(
 *     path="/vehicles/{id}",
 *     operationId="deleteVehicleById",
 *     tags={"Vehicles"},
 *     summary="Delete vehicle",
 *     description="Deletes vehicle data",
 *     @OA\Parameter(
 *         name="id",
 *         description="Vehicle id",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer",
 *             example="1"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfull operation",
 *         @OA\JsonContent(ref="#/components/schemas/EntityDeletedResponse")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(ref="#/components/schemas/EntityNotFoundResponse")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content. <br/> Contains 'message' key with first error message and 'errors' key object with keys - fields failed validation and arrays - value with errors",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/vehicles",
 *     operationId="getAllVehicles",
 *     tags={"Vehicles"},
 *     summary="Get all vehicles",
 *     description="Returns paginated vehicles data",
 *     @OA\Parameter(
 *         name="page",
 *         description="Page pagination parameter",
 *         required=false,
 *         in="query",
 *         @OA\Schema(
 *             type="string",
 *             example="2"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfull operation",
 *         @OA\JsonContent(ref="#/components/schemas/VehiclePaginatedResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/vehicles",
 *     operationId="createVehicle",
 *     tags={"Vehicles"},
 *     summary="Create new vehicle",
 *     description="Creates new vehicle and returns its data. All fields required and must present, but 'user_id' can be null",
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateVehicleRequest")
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/VehicleResponse")
 *      ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\JsonContent(ref="#/components/schemas/UserAlreadyHasVehicleResponse")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content. <br/> Contains 'message' key with first error message and 'errors' key object with keys - fields failed validation and arrays - value with errors",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponse")
 *     ),
 *     @OA\Response(
 *        response=500,
 *        description="Internal server error",
 *        @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *    ),
 * ),
 *
 * @OA\Put(
 *     path="/vehicles/{id}",
 *     operationId="updateVehicle",
 *     tags={"Vehicles"},
 *     summary="Update existing vehicle",
 *     description="Updates vehicle and returns its data. All fields required and must present, but 'user_id' can be null",
 *     @OA\Parameter(
 *         name="id",
 *         description="Vehicle id",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer",
 *             example="1"
 *         )
 *     ),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateVehicleRequest")
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/VehicleResponse")
 *      ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\JsonContent(ref="#/components/schemas/UserAlreadyHasVehicleResponse")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content. <br/> Contains 'message' key with first error message and 'errors' key object with keys - fields failed validation and arrays - value with errors",
 *         @OA\JsonContent(ref="#/components/schemas/UnprocessableContentResponse")
 *     ),
 *     @OA\Response(
 *        response=500,
 *        description="Internal server error",
 *        @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *    ),
 * )
 */
class VehicleController
{
}
