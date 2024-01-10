<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    const API_V1_USERS = '/api/v1/users/';

    public function testGetAllUsers()
    {
        $response = $this->get(self::API_V1_USERS);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'date_deleted',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function testGetNonExistentUser()
    {
        $user = User::factory()->create();

        $nonExistentUserId = $user->id + 1;
        $response = $this->get(self::API_V1_USERS . $nonExistentUserId);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'User not found.'
        ]);
    }

    public function testGetSingleUser()
    {
        $user = User::factory()->create();

        $response = $this->get(self::API_V1_USERS . $user->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'date_deleted',
            'created_at',
            'updated_at',
            ]);

        $response->assertJson([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'date_deleted' => $user->date_deleted,
        ]);
    }
}
