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
        $this->seed();

        $response = $this->get('/api/films');

        $films_array = json_decode($response->getContent(),true);
        $this->assertEquals(count($films_array['data']), 100);

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
}
