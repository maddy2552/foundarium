<?php

namespace Feature\User;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create user without vehicle.
     */
    public function testCreateUserWithoutVehicle(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response
            ->assertStatus(201)
            ->assertJson(static function (AssertableJson $json) use ($userToCreate) {
                $json->has('data', function (AssertableJson $json) use ($userToCreate) {
                    $json
                        ->where('first_name', $userToCreate['first_name'])
                        ->where('last_name', $userToCreate['last_name'])
                        ->where('vehicle', $userToCreate['vehicle_id'])
                        ->etc();
                });
            });
    }

    /**
     * Create user with vehicle.
     */
    public function testCreateUserWithVehicle(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response
            ->assertStatus(201)
            ->assertJson(static function (AssertableJson $json) use ($userToCreate, $vehicle) {
                $json->has('data', function (AssertableJson $json) use ($userToCreate, $vehicle) {
                    $json
                        ->where('first_name', $userToCreate['first_name'])
                        ->where('last_name', $userToCreate['last_name'])
                        ->has('vehicle', function (AssertableJson $json) use ($vehicle) {
                            $json
                                ->where('id', $vehicle->id)
                                ->where('name', $vehicle->name)
                                ->where('vin', $vehicle->vin)
                                ->where('created_at', $vehicle->created_at->toISOString())
                                ->where('updated_at', $vehicle->updated_at->toISOString());
                        })
                        ->etc();
                });
            });
    }

    /**
     * Create user with invalid min length first name.
     */
    public function testCreateUserWithInvalidMinLengthFirstName(): void
    {
        $userToCreate = [
            'first_name' => 'K',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with invalid max length first name.
     */
    public function testCreateUserWithInvalidMaxLengthFirstName(): void
    {
        $userToCreate = [
            'first_name' => Str::random(256),
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with invalid min length last name
     */
    public function testCreateUserWithInvalidMinLengthLastName(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'K',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with invalid max length last name
     */
    public function testCreateUserWithInvalidMaxLengthLastName(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => Str::random(256),
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with empty first name
     */
    public function testCreateUserWithEmptyFirstName(): void
    {
        $userToCreate = [
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with empty last name
     */
    public function testCreateUserWithEmptyLastName(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'vehicle_id' => null,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with empty vehicle id
     */
    public function testCreateUserWithEmptyVehicleId(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with not existing vehicle id.
     */
    public function testCreateUserWithNotExistingVehicleId(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => 0,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with invalid vehicle id.
     */
    public function testCreateUserWithInvalidVehicleId(): void
    {
        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => 'string',
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(422);
    }

    /**
     * Create user with vehicle id already has user.
     */
    public function testCreateUserWithVehicleIdAlreadyHasUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userToCreate = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => $user->vehicle_id,
        ];

        $response = $this->postJson(route('api.users.create'), $userToCreate);

        $response->assertStatus(400);
    }
}
