<?php

namespace Feature\User;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Update user without vehicle.
     */
    public function testUpdateUserWithoutVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'vehicle_id' => null,
        ]);

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                $json->has('data', function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $userInfoUpdateTo['first_name'])
                        ->where('last_name', $userInfoUpdateTo['last_name'])
                        ->where('vehicle', $userInfoUpdateTo['vehicle_id'])
                        ->where('created_at', $user->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update user with same vehicle.
     */
    public function testUpdateUserWithSameVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => $user->vehicle_id,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                $json->has('data', function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $userInfoUpdateTo['first_name'])
                        ->where('last_name', $userInfoUpdateTo['last_name'])
                        ->has('vehicle', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->vehicle->id)
                                ->where('name', $user->vehicle->name)
                                ->where('vin', $user->vehicle->vin)
                                ->where('created_at', $user->vehicle->created_at->toISOString())
                                ->where('updated_at', $user->vehicle->updated_at->toISOString());
                        })
                        ->where('created_at', $user->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update user set vehicle to null.
     */
    public function testUpdateUserSetVehicleToNull(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                $json->has('data', function (AssertableJson $json) use ($userInfoUpdateTo, $user) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $userInfoUpdateTo['first_name'])
                        ->where('last_name', $userInfoUpdateTo['last_name'])
                        ->where('vehicle', $userInfoUpdateTo['vehicle_id'])
                        ->where('created_at', $user->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update user set vehicle to another vehicle.
     */
    public function testUpdateUserSetVehicleToAnotherVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => $vehicle->id,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($userInfoUpdateTo, $user, $vehicle) {
                $json->has('data', function (AssertableJson $json) use ($userInfoUpdateTo, $user, $vehicle) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $userInfoUpdateTo['first_name'])
                        ->where('last_name', $userInfoUpdateTo['last_name'])
                        ->has('vehicle', function (AssertableJson $json) use ($vehicle) {
                            $json
                                ->where('id', $vehicle->id)
                                ->where('name', $vehicle->name)
                                ->where('vin', $vehicle->vin)
                                ->where('created_at', $vehicle->created_at->toISOString())
                                ->where('updated_at', $vehicle->updated_at->toISOString());
                        })
                        ->where('created_at', $user->created_at->toISOString())
                        ->etc();
                });
            });
    }

    /**
     * Update user with invalid min length first name.
     */
    public function testUpdateUserWithInvalidMinLengthFirstName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'K',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with invalid max length first name.
     */
    public function testUpdateUserWithInvalidMaxLengthFirstName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => Str::random(256),
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with invalid min length last name
     */
    public function testUpdateUserWithInvalidMinLengthLastName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'K',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with invalid max length last name
     */
    public function testUpdateUserWithInvalidMaxLengthLastName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => Str::random(256),
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with empty first name
     */
    public function testUpdateUserWithEmptyFirstName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'last_name' => 'Kushnaryov',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with empty last name
     */
    public function testUpdateUserWithEmptyLastName(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'vehicle_id' => null,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with empty vehicle id
     */
    public function testUpdateUserWithEmptyVehicleId(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with not existing vehicle id.
     */
    public function testUpdateUserWithNotExistingVehicleId(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => 0,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with invalid vehicle id.
     */
    public function testUpdateUserWithInvalidVehicleId(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => 'string',
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $user->id]), $userInfoUpdateTo);

        $response->assertStatus(422);
    }

    /**
     * Update user with vehicle id already has user.
     */
    public function testCreateUserWithVehicleIdAlreadyHasUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var User $userToUpdate */
        $userToUpdate = User::factory()->create();

        $userInfoUpdateTo = [
            'first_name' => 'Kirill',
            'last_name' => 'Kushnaryov',
            'vehicle_id' => $user->vehicle_id,
        ];

        $response = $this->putJson(route('api.users.update', ['id' => $userToUpdate->id]), $userInfoUpdateTo);

        $response->assertStatus(400);
    }
}
