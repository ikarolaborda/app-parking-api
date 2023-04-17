<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanGetTheirProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/v1/profile');

        $response->assertStatus(200)
            ->assertJsonStructure(['user' => ['id','name', 'email','birth_date', 'Age']])
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => $user->name]);
    }

    public function testUserCanUpdateNameEmailAndBirthDate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/v1/profile', [
            'name'  => 'John Updated',
            'email' => 'john_updated@example.com',
            'birth_date' => '1990-01-01'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message'])
            ->assertJsonCount(2)
            ->assertJsonFragment(['0' => 202]);

        $this->assertDatabaseHas('users', [
            'name'  => 'John Updated',
            'email' => 'john_updated@example.com',
        ]);
    }

    public function testUserCanChangePassword()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/v1/password', [
            'current_password'      => 'password',
            'password'              => 'testing123',
            'password_confirmation' => 'testing123',
        ]);

        $response->assertStatus(202);
    }

    public function testGuestUserShouldntBeAbleToViewProfile()
    {
        $response = $this->getJson('/api/v1/profile');

        $response->assertStatus(401);
    }
}
