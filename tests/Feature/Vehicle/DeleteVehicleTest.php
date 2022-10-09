<?php

namespace Feature\Vehicle;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteVehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Delete not existing vehicle.
     */
    public function testDeleteNotExistingVehicle(): void
    {
        $response = $this->getJson(route('api.vehicles.delete', ['id' => 0]));
        $response->assertStatus(404);
    }

    /**
     * Delete vehicle with invalid id.
     */
    public function testDeleteVehicleWithInvalidId(): void
    {
        $response = $this->getJson(route('api.vehicles.delete', ['id' => 'string']));
        $response->assertStatus(422);
    }

    /**
     * Delete vehicle with valid id.
     */
    public function testDeleteVehicle(): void
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::factory()->create();

        $response = $this->getJson(route('api.vehicles.delete', ['id' => $vehicle->id]));
        $response->assertStatus(200);
    }
}
