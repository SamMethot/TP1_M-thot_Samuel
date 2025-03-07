<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Critic;
use App\Models\User;
use App\Models\Film;
use App\Models\Language;

class CriticTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testDeleteCritic(): void
    {
        $user = User::create([
            'last_name' => 'test',
            'first_name' => 'test',
            'login' => 'test',
            'email' => 'test@test.com',
            'password' => 'pass'
        ]);

        $language = Language::create([
            'name' => 'test'
        ]);

        $film = Film::create([
            'title' => 'test',
            'release_year' => 2021,
            'length' => 120,
            'description' => 'test',
            'rating' => 'G',
            'language_id' => 1,
            'special_features' => 'test',
            'image' => 'test'
        ]);

        $critic = Critic::create([
            'user_id' => $user->id,
            'film_id' => $film->id,
            'user_id' => $user->id,
            'film_id' => 1,
            'score' => 5,
            'comment' => 'test comment'
        ]);

        $response = $this->delete('/api/critics/' . $critic->id);        
        $response->assertStatus(204);
    }
}