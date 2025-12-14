<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        // Arrange: Prepare data
        $data = [
            'name' => 'prokash banik',
            'email' => 'prokashbanik85@gmail.com',
            'password' => bcrypt('password')
        ];

        // Act: Perform the action
        $response = $this->postJson('/api/users', $data);

        // Assert: Check the outcome
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'prokashbanik85@gmail.com'
        ]);
    }
}
