<?php

namespace App\Http\Controllers\Api\V1;

use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Exceptions\Api\VehicleAlreadyHasUser;
use App\Exceptions\Api\EntityNotFoundException;
use App\Http\Requests\User\GetOrDeleteUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    use ApiResponseHelpers;

    /**
     * @param  UserService  $userService
     */
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Get all users
     *
     * @return AnonymousResourceCollection
     */
    public function getUsers(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->getUsersPaginated());
    }

    /**
     * Get user by id
     *
     * @param  GetOrDeleteUserRequest  $request
     * @return UserResource
     * @throws EntityNotFoundException
     */
    public function getUser(GetOrDeleteUserRequest $request): UserResource
    {
        return new UserResource($this->userService->getUser($request->validated('id'), ['vehicle']));
    }

    /**
     * Create new user entity
     *
     * @param  CreateUserRequest  $request
     * @return UserResource
     * @throws VehicleAlreadyHasUser
     */
    public function createUser(CreateUserRequest $request): UserResource
    {
        return new UserResource($this->userService->createUser($request->validated()));
    }

    /**
     * Update user entity
     *
     * @param  UpdateUserRequest  $request
     * @return UserResource
     * @throws EntityNotFoundException
     * @throws VehicleAlreadyHasUser
     */
    public function updateUser(UpdateUserRequest $request): UserResource
    {
        return new UserResource($this->userService->updateUser($request->validated()));
    }

    /**
     * Delete user entity
     *
     * @param  GetOrDeleteUserRequest  $request
     * @return JsonResponse
     * @throws EntityNotFoundException
     */
    public function deleteUser(GetOrDeleteUserRequest $request): JsonResponse
    {
        $this->userService->deleteUser($request->validated('id'));
        return $this->respondOk(__('api.entity.deleted'));
    }
}
