<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Vehicle;
use App\Exceptions\Api\UserAlreadyHasVehicle;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\Api\EntityNotFoundException;

class VehicleService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getVehiclesPaginated(): LengthAwarePaginator
    {
        return Vehicle::with('user')->paginate();
    }

    /**
     * @param  int  $id
     * @param  array  $relations
     * @return Vehicle
     * @throws EntityNotFoundException
     */
    public function getVehicle(int $id, array $relations = []): Vehicle
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::with($relations)->find($id);

        if (!$vehicle) {
            throw new EntityNotFoundException();
        }

        return $vehicle;
    }

    /**
     * @param  int  $id
     * @return bool
     * @throws EntityNotFoundException
     */
    public function deleteVehicle(int $id): bool
    {
        $vehicle = $this->getVehicle($id, ['user']);

        if ($vehicle->user) {
            $vehicle->user->vehicle_id = null;
            $vehicle->user->save();
        }

        return $vehicle->delete();
    }

    /**
     * @param  array  $data
     * @return Vehicle
     * @throws UserAlreadyHasVehicle
     */
    public function createVehicle(array $data): Vehicle
    {
        $user = User::with('vehicle')->find($data['user_id']);

        if ($user?->vehicle) {
            throw new UserAlreadyHasVehicle();
        }

        $vehicle = Vehicle::create($data);

        if ($user) {
            $vehicle->user()->save($user);
        }

        $vehicle->load('user');

        return $vehicle;
    }

    /**
     * @param  array  $data
     * @return Vehicle
     * @throws EntityNotFoundException
     * @throws UserAlreadyHasVehicle
     */
    public function updateVehicle(array $data): Vehicle
    {
        $vehicle = $this->getVehicle($data['id'], ['user']);

        /** @var User $user */
        $user = User::with('vehicle')->find($data['user_id']);

        if ($user?->vehicle && $user->vehicle->id !== $vehicle->id) {
            throw new UserAlreadyHasVehicle();
        }

        if ($vehicle->user && !$data['user_id']) {
            $vehicle->user->vehicle_id = null;
            $vehicle->user->save();
            $vehicle->load('user');
        }

        if ($user && $vehicle->user && $user->id !== $vehicle->user->id) {
            $vehicle->user->vehicle_id = null;
            $user->vehicle_id = $vehicle->id;

            $vehicle->user->save();
            $user->save();

            $vehicle->load('user');
        }

        if ($user && !$vehicle->user) {
            $vehicle->user()->save($user);
            $vehicle->load('user');
        }

        $vehicle->update($data);

        return $vehicle;
    }
}
