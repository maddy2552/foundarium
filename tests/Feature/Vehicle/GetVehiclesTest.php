<?php

namespace Feature\Vehicle;

use App\Models\Vehicle;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetVehiclesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get all vehicles paginated.
     *
     * @return void
     */
    public function testGetAllVehicles(): void
    {
        Vehicle::factory()->count(10)->create();

        $response = $this->getJson(route('api.vehicles.all'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'vin',
                        'user',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active',
                        ],
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    /**
     * Get all vehicles paginated with page parameter.
     */
    public function testGetAllVehiclesWithPageParameter(): void
    {
        Vehicle::factory()->count(100)->create();

        $pageNumber = 2;

        $response = $this->getJson(route('api.vehicles.all', ['page' => $pageNumber]));

        $response
            ->assertStatus(200)
            ->assertJsonCount(15, 'data')
            ->assertJson(static function (AssertableJson $json) use ($pageNumber) {
                $json->has('meta', function (AssertableJson $json) use ($pageNumber) {
                    $json->where('current_page', $pageNumber)
                        ->etc();
                })->etc();
            })
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'vin',
                        'user',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active',
                        ],
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    /**
     * Get all vehicles with not existing page parameter.
     */
    public function testGetVehiclesWithNotExistingPageParameter(): void
    {
        $pageNumber = 100;

        $response = $this->getJson(route('api.vehicles.all', ['page' => $pageNumber]));

        $response
            ->assertStatus(200)
            ->assertJsonCount(0, 'data')
            ->assertJson(static function (AssertableJson $json) use ($pageNumber) {
                $json->has('meta', function (AssertableJson $json) use ($pageNumber) {
                    $json->where('current_page', $pageNumber)
                        ->etc();
                })->etc();
            })
            ->assertJsonStructure([
                'data' => [],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active',
                        ],
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }
}
