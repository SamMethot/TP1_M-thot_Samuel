<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Language;

class FilmsTest extends TestCase
{   
    use RefreshDatabase;

    public function testGetFilms(): void
    {
        $languages = Language::create([
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

        $response = $this->get('/api/films');

        $films_array = json_decode($response->getContent(),true);
        $this->assertEquals(count($films_array['data']), 1);

        foreach($films_array['data'] as $film){
            $this->assertArrayHasKey('title', $film);
            $this->assertArrayHasKey('description', $film);
            $this->assertArrayHasKey('release_year', $film);
            $this->assertArrayHasKey('language_id', $film);
            $this->assertArrayHasKey('length', $film);
            $this->assertArrayHasKey('rating', $film);
            $this->assertArrayHasKey('special_features', $film);
            $this->assertArrayHasKey('image', $film);
        }
        $response->assertStatus(200);
    }

    public function testPostFilmShouldReturn422WhenMissingField()
    {
        $this->seed();

        $json = [
            'title' => 'test',
            'release_year' => 2021,
            'length' => 120,
            'description' => 'test',
            'rating' => 'G',
            'language_id' => 1,
            'image' => 'test'
        ];

        
        $response = $this->postJson('/api/films', $json);
        
        $response->assertStatus(422);
    }
}
