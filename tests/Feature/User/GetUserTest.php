<?php

namespace Feature\User;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user without vehicle.
     */
    public function testGetUserWithoutVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'vehicle_id' => null,
        ]);

        $response = $this->getJson(route('api.users.get', ['id' => $user->id]));

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($user) {
                $json->has('data', function (AssertableJson $json) use ($user) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $user->first_name)
                        ->where('last_name', $user->last_name)
                        ->where('vehicle', null)
                        ->where('created_at', $user->created_at->toISOString())
                        ->where('updated_at', $user->updated_at->toISOString());
                });
            });
    }

    /**
     * Test user with vehicle.
     */
    public function testGetUserWithVehicle(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->getJson(route('api.users.get', ['id' => $user->id]));

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($user) {
                $json->has('data', function (AssertableJson $json) use ($user) {
                    $json
                        ->where('id', $user->id)
                        ->where('first_name', $user->first_name)
                        ->where('last_name', $user->last_name)
                        ->where('created_at', $user->created_at->toISOString())
                        ->where('updated_at', $user->updated_at->toISOString())
                        ->has('vehicle', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->vehicle->id)
                                ->where('name', $user->vehicle->name)
                                ->where('vin', $user->vehicle->vin)
                                ->where('created_at', $user->vehicle->created_at->toISOString())
                                ->where('updated_at', $user->vehicle->updated_at->toISOString());
                        });
                });
            });
    }

    /**
     * Get user with not existing id.
     */
    public function testGetUserWithNotExistingId(): void
    {
        $response = $this->getJson(route('api.users.get', ['id' => 1]));

        $response->assertStatus(404);
    }

    /**
     * Get user with invalid id.
     */
    public function testGetUserWithInvalidId(): void
    {
        $response = $this->getJson(route('api.users.get', ['id' => 'string']));

        $response->assertStatus(422);
    }
}
