<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Vehicle;
use App\Exceptions\Api\VehicleAlreadyHasUser;
use App\Exceptions\Api\EntityNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * @param  int  $id
     * @param  array  $relations
     * @return User
     * @throws EntityNotFoundException
     */
    public function getUser(int $id, array $relations = []): User
    {
        /** @var User $user */
        $user = User::with($relations)->find($id);

        if (!$user) {
            throw new EntityNotFoundException();
        }

        return $user;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getUsersPaginated(): LengthAwarePaginator
    {
        return User::with('vehicle')->paginate();
    }

    /**
     * @param  int  $id
     * @return bool
     * @throws EntityNotFoundException
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->getUser($id);
        return $user->delete();
    }

    /**
     * @param  array  $data
     * @return User
     * @throws VehicleAlreadyHasUser
     */
    public function createUser(array $data): User
    {
        $vehicle = Vehicle::with('user')->find($data['vehicle_id']);

        if ($vehicle?->user) {
            throw new VehicleAlreadyHasUser();
        }

        return User::create($data)->load('vehicle');
    }

    /**
     * @param  array  $data
     * @return User
     * @throws EntityNotFoundException
     * @throws VehicleAlreadyHasUser
     */
    public function updateUser(array $data): User
    {
        $user = $this->getUser($data['id']);

        $vehicle = Vehicle::with('user')->find($data['vehicle_id']);

        if ($vehicle?->user && $vehicle->user->id !== $user->id) {
            throw new VehicleAlreadyHasUser();
        }

        $user->update($data);
        $user->load('vehicle');

        return $user;
    }
}
