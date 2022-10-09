<?php

namespace Feature\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateVehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create user without vehicle.
     */
    public function testCreateVehicleWithoutUser(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response
            ->assertStatus(201)
            ->assertJson(static function (AssertableJson $json) use ($vehicleToCreate) {
                $json->has('data', function (AssertableJson $json) use ($vehicleToCreate) {
                    $json
                        ->where('name', $vehicleToCreate['name'])
                        ->where('vin', $vehicleToCreate['vin'])
                        ->where('user', $vehicleToCreate['user_id'])
                        ->etc();
                });
            });
    }

    /**
     * Create vehicle with user.
     */
    public function testCreateVehicleWithUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'vehicle_id' => null,
        ]);

        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => $user->id,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response
            ->assertStatus(201)
            ->assertJson(static function (AssertableJson $json) use ($vehicleToCreate, $user) {
                $json->has('data', function (AssertableJson $json) use ($vehicleToCreate, $user) {
                    $json
                        ->where('name', $vehicleToCreate['name'])
                        ->where('vin', $vehicleToCreate['vin'])
                        ->has('user', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->id)
                                ->where('first_name', $user->first_name)
                                ->where('last_name', $user->last_name)
                                ->where('created_at', $user->created_at->toISOString())
                                ->etc();
                        })
                        ->etc();
                });
            });
    }

    /**
     * Create vehicle with invalid min length name.
     */
    public function testCreateVehicleWithInvalidMinLengthName(): void
    {
        $vehicleToCreate = [
            'name' => 'O',
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with invalid max length name.
     */
    public function testCreateVehicleWithInvalidMaxLengthName(): void
    {
        $vehicleToCreate = [
            'name' => Str::random(256),
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with invalid min length vin.
     */
    public function testCreateVehicleWithInvalidMinLengthVin(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => '1',
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with invalid max length vin.
     */
    public function testCreateVehicleWithInvalidMaxLengthVin(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(256),
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with not unique vin.
     */
    public function testCreateVehicleWithNotUniqueVin(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => $vehicle->vin,
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with empty name.
     */
    public function testCreateVehicleWithEmptyName(): void
    {
        $vehicleToCreate = [
            'vin' => Str::random(17),
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with empty vin.
     */
    public function testCreateVehicleWithEmptyVin(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'user_id' => null,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with empty user id.
     */
    public function testCreateVehicleWithEmptyUserId(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with not existing user id.
     */
    public function testCreateVehicleWithNotExistingUserId(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => 0,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with invalid user id.
     */
    public function testCreateVehicleWithInvalidUserId(): void
    {
        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => 'string',
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create vehicle with user id already has vehicle.
     */
    public function testCreateVehicleWithUserIdAlreadyHasVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $vehicleToCreate = [
            'name' => 'Opel',
            'vin' => Str::random(17),
            'user_id' => $user->id,
        ];

        $response = $this->postJson(route('api.vehicles.create'), $vehicleToCreate);

        $response->assertStatus(400);
    }
}
