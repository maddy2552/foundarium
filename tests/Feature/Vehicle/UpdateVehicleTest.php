<?php

namespace Feature\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateVehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Update vehicle without user.
     */
    public function testUpdateVehicleWithoutUser(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Nissan',
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle) {
                $json->has('data', function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicleInfoUpdateTo['name'])
                        ->where('vin', $vehicleInfoUpdateTo['vin'])
                        ->where('user', $vehicleInfoUpdateTo['user_id'])
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update vehicle with same user.
     */
    public function testUpdateVehicleWitSameUser(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        /** @var User $user */
        $user = User::factory()->create([
            'vehicle_id' => $vehicle->id,
        ]);

        $vehicleInfoUpdateTo = [
            'name' => 'Nissan',
            'vin' => Str::random(17),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $user) {
                $json->has('data', function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $user) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicleInfoUpdateTo['name'])
                        ->where('vin', $vehicleInfoUpdateTo['vin'])
                        ->has('user', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->id)
                                ->where('first_name', $user->first_name)
                                ->where('last_name', $user->last_name)
                                ->where('created_at', $user->created_at->toISOString())
                                ->where('updated_at', $user->updated_at->toISOString());
                        })
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update vehicle set user to null.
     */
    public function testUpdateVehicleSetUserToNull(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        User::factory()->create([
            'vehicle_id' => $vehicle->id,
        ]);

        $vehicleInfoUpdateTo = [
            'name' => 'Nissan',
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle) {
                $json->has('data', function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicleInfoUpdateTo['name'])
                        ->where('vin', $vehicleInfoUpdateTo['vin'])
                        ->where('user', $vehicleInfoUpdateTo['user_id'])
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update vehicle set user to another user.
     */
    public function testUpdateVehicleSetUserToAnotherUser(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        User::factory()->create([
            'vehicle_id' => $vehicle->id,
        ]);

        /** @var User $userUpdateTo */
        $userUpdateTo = User::factory()->create([
            'vehicle_id' => null,
        ]);

        $vehicleInfoUpdateTo = [
            'name' => 'Nissan',
            'vin' => Str::random(17),
            'user_id' => $userUpdateTo->id,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $userUpdateTo) {
                $json->has('data', function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $userUpdateTo) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicleInfoUpdateTo['name'])
                        ->where('vin', $vehicleInfoUpdateTo['vin'])
                        ->has('user', function (AssertableJson $json) use ($userUpdateTo) {
                            $json
                                ->where('id', $userUpdateTo->id)
                                ->where('first_name', $userUpdateTo->first_name)
                                ->where('last_name', $userUpdateTo->last_name)
                                ->where('created_at', $userUpdateTo->created_at->toISOString())
                                ->where('updated_at', $userUpdateTo->updated_at->toISOString());
                        })
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update vehicle set user.
     */
    public function testUpdateVehicleSetUser(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        /** @var User $user */
        $user = User::factory()->create([
            'vehicle_id' => null,
        ]);

        $vehicleInfoUpdateTo = [
            'name' => 'Nissan',
            'vin' => Str::random(17),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $user) {
                $json->has('data', function (AssertableJson $json) use ($vehicleInfoUpdateTo, $vehicle, $user) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicleInfoUpdateTo['name'])
                        ->where('vin', $vehicleInfoUpdateTo['vin'])
                        ->has('user', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->id)
                                ->where('first_name', $user->first_name)
                                ->where('last_name', $user->last_name)
                                ->where('created_at', $user->created_at->toISOString())
                                ->where('updated_at', $user->updated_at->toISOString());
                        })
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update vehicle with invalid min length name.
     */
    public function testUpdateVehicleWithInvalidMinLengthName(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'O',
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with invalid max length name.
     */
    public function testUpdateVehicleWithInvalidMaxLengthName(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => Str::random(256),
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with invalid min length vin.
     */
    public function testUpdateVehicleWithInvalidMinLengthVin(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => '1',
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with invalid max length vin.
     */
    public function testUpdateVehicleWithInvalidMaxLengthVin(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => Str::random(256),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with not unique vin.
     */
    public function testUpdateVehicleWithNotUniqueVin(): void
    {
        /** @var Vehicle $oldVehicle */
        $oldVehicle = Vehicle::factory()->create();

        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => $oldVehicle->vin,
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with empty name.
     */
    public function testUpdateVehicleWithEmptyName(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with empty vin.
     */
    public function testUpdateVehicleWithEmptyVin(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'user_id' => null,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with empty user id.
     */
    public function testUpdateVehicleWithEmptyUserId(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => Str::random(17),
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with not existing user id.
     */
    public function testUpdateVehicleWithNotExistingUserId(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => 0,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with invalid user id.
     */
    public function testUpdateVehicleWithInvalidUserId(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => 'string',
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update vehicle with user id already has vehicle.
     */
    public function testUpdateVehicleWithUserIdAlreadyHasVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleInfoUpdateTo = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.vehicles.update', ['id' => $vehicle->id]), $vehicleInfoUpdateTo);

        $response->assertStatus(400);
    }
}
