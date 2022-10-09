<?php

namespace Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Delete not existing user.
     */
    public function testDeleteNotExistingUser(): void
    {
        $response = $this->getJson(route('api.users.delete', ['id' => 1]));
        $response->assertStatus(404);
    }

    /**
     * Delete user with invalid id.
     */
    public function testDeleteUserWithInvalidId(): void
    {
        $response = $this->getJson(route('api.users.delete', ['id' => 'string']));
        $response->assertStatus(422);
    }

    /**
     * Delete user with valid id.
     */
    public function testDeleteUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->getJson(route('api.users.delete', ['id' => $user->id]));
        $response->assertStatus(200);
    }
}
