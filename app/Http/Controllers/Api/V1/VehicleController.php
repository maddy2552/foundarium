<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Services\VehicleService;
use App\Exceptions\Api\UserAlreadyHasVehicle;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Exceptions\Api\EntityNotFoundException;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Requests\Vehicle\GetOrDeleteVehicleRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{
    /**
     * @param  VehicleService  $vehicleService
     */
    public function __construct(private VehicleService $vehicleService)
    {
    }

    /**
     * Get all vehicles
     *
     * @return AnonymousResourceCollection
     */
    public function getVehicles(): AnonymousResourceCollection
    {
        return VehicleResource::collection($this->vehicleService->getVehiclesPaginated());
    }

    /**
     * Get vehicle by id
     *
     * @param  GetOrDeleteVehicleRequest  $request
     * @return VehicleResource
     * @throws EntityNotFoundException
     */
    public function getVehicle(GetOrDeleteVehicleRequest $request): VehicleResource
    {
        return new VehicleResource($this->vehicleService->getVehicle($request->validated('id'), ['user']));
    }

    /**
     * Create new vehicle entity
     *
     * @param  CreateVehicleRequest  $request
     * @return VehicleResource
     * @throws UserAlreadyHasVehicle
     */
    public function createVehicle(CreateVehicleRequest $request): VehicleResource
    {
        return new VehicleResource($this->vehicleService->createVehicle($request->validated()));
    }

    /**
     * Update vehicle entity
     *
     * @param  UpdateVehicleRequest  $request
     * @return VehicleResource
     * @throws EntityNotFoundException
     * @throws UserAlreadyHasVehicle
     */
    public function updateVehicle(UpdateVehicleRequest $request): VehicleResource
    {
        return new VehicleResource($this->vehicleService->updateVehicle($request->validated()));
    }

    /**
     * Delete vehicle entity
     *
     * @param  GetOrDeleteVehicleRequest  $request
     * @return JsonResponse
     * @throws EntityNotFoundException
     */
    public function deleteVehicle(GetOrDeleteVehicleRequest $request): JsonResponse
    {
        $this->vehicleService->deleteVehicle($request->validated('id'));
        return $this->respondOk(__('api.entity.deleted'));
    }
}
