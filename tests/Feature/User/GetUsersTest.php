<?php

namespace Feature\User;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get all users paginated.
     *
     * @return void
     */
    public function testGetAllUsers(): void
    {
        User::factory()->count(10)->create();

        $response = $this->getJson(route('api.users.all'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                        'vehicle',
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
     * Get all users paginated with page parameter.
     */
    public function testGetAllUsersWithPageParameter(): void
    {
        User::factory()->count(100)->create();

        $pageNumber = 2;

        $response = $this->getJson(route('api.users.all', ['page' => $pageNumber]));

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
                        'first_name',
                        'last_name',
                        'vehicle',
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
     * Get all users with not existing page parameter.
     */
    public function testGetUsersWithNotExistingPageParameter(): void
    {
        $pageNumber = 100;

        $response = $this->getJson(route('api.users.all', ['page' => $pageNumber]));

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
