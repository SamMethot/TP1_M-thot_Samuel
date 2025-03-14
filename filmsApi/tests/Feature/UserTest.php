<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function testPostUser(): void
    {

        $this->seed();
        $user = User::first();
        $response = $this->post('/api/users', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            'login' => $user->login,
        ]);
        $response->assertStatus(201);
    }

    public function testPostUserShouldReturn302IfMissingField(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->post('/api/users', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $response->assertStatus(302);
    }

    public function testPostUserShouldReturn302IfInvalidField(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->post('/api/users', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => 'assssssdkfkjfnwkfwefssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
            'password' => $user->password,
            'login' => $user->login,
        ]);
        $response->assertStatus(302);
    }

    public function testPutUser(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->put('/api/users/' . $user->id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            'login' => $user->login,
        ]);
        $response->assertStatus(200);
    }

    public function testPutUserShouldReturn302IfMissingField(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->put('/api/users/' . $user->id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $response->assertStatus(302);
    }

    public function testPutUserShouldReturn302IfInvalidField(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->put('/api/users/' . $user->id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => 'assssssdkfkjfnwkfwefaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'password' => $user->password,
            'login' => $user->login,
        ]);
        $response->assertStatus(302);
    }

    public function testPutUserNotFound(): void
    {
        $this->seed();
        $user = User::first();
        $response = $this->put('/api/users/10122312312300', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            'login' => $user->login,
        ]);
        $response->assertStatus(500);
    }
}
