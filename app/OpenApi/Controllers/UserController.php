<?php

namespace App\OpenApi\Controllers;

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     operationId="getUserById",
 *     tags={"Users"},
 *     summary="Get user information",
 *     description="Returns user data",
 *     @OA\Parameter(
 *         name="id",
 *         description="User id",
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
 *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
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
 *     path="/users/{id}",
 *     operationId="deleteUserById",
 *     tags={"Users"},
 *     summary="Delete user",
 *     description="Deletes user data",
 *     @OA\Parameter(
 *         name="id",
 *         description="User id",
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
 *     path="/users",
 *     operationId="getAllUsers",
 *     tags={"Users"},
 *     summary="Get all users",
 *     description="Returns paginated users data",
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
 *         @OA\JsonContent(ref="#/components/schemas/UserPaginatedResponse")
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *         @OA\JsonContent(ref="#/components/schemas/InternalServerErrorResponse")
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/users",
 *     operationId="createUser",
 *     tags={"Users"},
 *     summary="Create new user",
 *     description="Creates new user and returns its data. All fields required and must present, but 'vehicle_id' can be null",
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateUserRequest")
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
 *      ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\JsonContent(ref="#/components/schemas/VehicleAlreadyHasUserResponse")
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
 *     path="/users/{id}",
 *     operationId="updateUser",
 *     tags={"Users"},
 *     summary="Update existing user",
 *     description="Updates user and returns its data. All fields required and must present, but 'vehicle_id' can be null",
 *     @OA\Parameter(
 *         name="id",
 *         description="User id",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="integer",
 *             example="1"
 *         )
 *     ),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateUserRequest")
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
 *      ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\JsonContent(ref="#/components/schemas/VehicleAlreadyHasUserResponse")
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
class UserController
{
}
