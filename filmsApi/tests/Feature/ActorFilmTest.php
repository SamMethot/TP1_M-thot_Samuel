<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Actor;
use App\Models\Film;
use App\Models\Language;
use App\Models\User;

class ActorFilmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetActorsFromOneFilmNoInformationShouldReturnStatus404(): void
    {

        $response = $this->get('/api/films/1/actors');
        $response->assertStatus(404);
    }

    public function testGetActorsFromOneFilmShouldReturnStatus200(): void
    {

        $language = Language::create([
            'name' => 'test'
        ]);

        $films = Film::create([
            'title' => 'test',
            'release_year' => 2021,
            'length' => 120,
            'description' => 'test',
            'rating' => 'G',
            'language_id' => 1,
            'special_features' => 'test',
            'image' => 'test'
        ]);

        $actors = Actor::create([
            'first_name' => 'test',
            'last_name' => 'test',
            'rating' => 'G',
            'favorite_movie_id' => 1,
            'birthdate' => '2021-01-01',
        ]);

        $response = $this->get('/api/films/1/actors');
        $response->assertStatus(200);
    }
}
