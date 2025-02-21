<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;

class FilmsTest extends TestCase
{
    use RefreshDatabase;

    public function testPostFilms(): void
    {
        $this->seed();

        $json = ['title'=>'test song', 
                'description'=>'test description', 
                'release_year'=>2021, 
                'language_id'=>1, 
                'rental_duration'=>1, 
                'rental_rate'=>1.1, 
                'length'=>1, 
                'replacement_cost'=>1.1, 
                'rating'=>'G', 
                'special_features'=>'Trailers'];

        $response = $this->postJson('/api/films', $json);
        $response->assertJsonFragment($json);
        $response->assertStatus(201);
    }

    public function testGetFilms(): void
    {
        $this->seed();
        
        $response = $this->get('/api/films');

        $films_array = json_decode($response->getContent(),true);
        $this->assertEquals(count($films_array['data']), 10);

        foreach($films_array['data'] as $film){
            $this->assertArrayHasKey('title', $film);
            $this->assertArrayHasKey('description', $film);
            $this->assertArrayHasKey('release_year', $film);
            $this->assertArrayHasKey('language_id', $film);
            $this->assertArrayHasKey('rental_duration', $film);
            $this->assertArrayHasKey('rental_rate', $film);
            $this->assertArrayHasKey('length', $film);
            $this->assertArrayHasKey('replacement_cost', $film);
            $this->assertArrayHasKey('rating', $film);
            $this->assertArrayHasKey('special_features', $film);
        }
        $response->assertStatus(200);
    }

    public function testPostFilmShouldReturn422WhenMissingField()
    {
        $this->seed();

        $json = ['title'=>'test song', 
                'description'=>'test description', 
                'release_year'=>'sidaod', 
                'language_id'=>1, 
                'rental_duration'=>1, 
                'rental_rate'=>1.1, 
                'length'=>1, 
                'replacement_cost'=>1.1, 
                'rating'=>'G'];

        
        $response = $this->postJson('/api/films', $json);
        
        $response->assertStatus(422);
    }

    public function testGetOneFilm()
    {

        $this->seed();
        $film = Film::first();
        $response = $this->get('/api/films/'.$film->id);

        $response->assertJsonFragment(['title'=>$film->title]);
        $response->assertJsonFragment(['description'=>$film->description]);
        $response->assertJsonFragment(['release_year'=>$film->release_year]);
        $response->assertJsonFragment(['language_id'=>$film->language_id]);
        $response->assertJsonFragment(['rental_duration'=>$film->rental_duration]);
        $response->assertJsonFragment(['rental_rate'=>$film->rental_rate]);
        $response->assertJsonFragment(['length'=>$film->length]);
        $response->assertJsonFragment(['replacement_cost'=>$film->replacement_cost]);
        $response->assertJsonFragment(['rating'=>$film->rating]);
        $response->assertJsonFragment(['special_features'=>$film->special_features]);

        $response->assertStatus(200);
    }

    public function testDestroyFilm()
    {
        $this->seed();
        $film = Film::first();
        $response = $this->delete('/api/films/'.$film->id);
        $response->assertStatus(204);
    }
}
