<?php

namespace Feature\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetVehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get vehicle without user.
     */
    public function testGetVehicleWithoutUser(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $response = $this->getJson(route('api.vehicles.get', ['id' => $vehicle->id]));

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicle) {
                $json->has('data', function (AssertableJson $json) use ($vehicle) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicle->name)
                        ->where('vin', $vehicle->vin)
                        ->where('user', null)
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->where('updated_at', $vehicle->updated_at->toISOString());
                });
            });
    }

    /**
     * Get vehicle with user.
     */
    public function testGetVehicleWithUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Vehicle $vehicle */
        $vehicle = $user->vehicle;

        $response = $this->getJson(route('api.vehicles.get', ['id' => $vehicle->id]));

        $response
            ->assertStatus(200)
            ->assertJson(static function (AssertableJson $json) use ($vehicle, $user) {
                $json->has('data', function (AssertableJson $json) use ($vehicle, $user) {
                    $json
                        ->where('id', $vehicle->id)
                        ->where('name', $vehicle->name)
                        ->where('vin', $vehicle->vin)
                        ->has('user', function (AssertableJson $json) use ($user) {
                            $json
                                ->where('id', $user->id)
                                ->where('first_name', $user->first_name)
                                ->where('last_name', $user->last_name)
                                ->where('created_at', $user->created_at->toISOString())
                                ->where('updated_at', $user->updated_at->toISOString());
                        })
                        ->where('created_at', $vehicle->created_at->toISOString())
                        ->where('updated_at', $vehicle->updated_at->toISOString());
                });
            });
    }

    /**
     * Get vehicle with not existing id.
     */
    public function testGetVehicleWithNotExistingId(): void
    {
        $response = $this->getJson(route('api.vehicles.get', ['id' => 0]));
        $response->assertStatus(404);
    }

    /**
     * Get vehicle with invalid id.
     */
    public function testGetVehicleWithInvalidId(): void
    {
        $response = $this->getJson(route('api.vehicles.get', ['id' => 'string']));
        $response->assertStatus(422);
    }
}
