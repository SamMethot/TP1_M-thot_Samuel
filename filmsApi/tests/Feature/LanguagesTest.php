<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Language;

class LanguagesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetLanguages()
    {
        $this->seed();
        
        $response = $this->get('/api/languages');

        $languages_array = json_decode($response->getContent(),true);
        $this->assertEquals(count($languages_array['data']), 3);

        foreach($languages_array['data'] as $language){
            $this->assertArrayHasKey('name', $language);
        }
        $response->assertStatus(200);
    }
    
    public function testGetOneLanguage()
    {
        $this->seed();
        
        $response = $this->get('/api/languages/1');

        $language = json_decode($response->getContent(),true);
        $this->assertEquals($language['data']['name'], 'English');
        $response->assertStatus(200);
    }

    public function testGetOneLanguageShouldReturn500WhenLanguageNotFound()
    {
        $this->seed();
        
        $response = $this->get('/api/languages/4');
        $response->assertStatus(500);
    }

    public function testGetLanguageAssociatedWithFilms() 
    {
        $this->seed();
        
        $response = $this->get('/api/languages/1/films');

        $films_array = json_decode($response->getContent(),true);
        $this->assertEquals(count($films_array['films']), 91);

        foreach($films_array['films'] as $film){
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

    public function testAvg()
    {
        $this->seed();
        
        $response = $this->get('/api/avg/1');

        $avg = json_decode($response->getContent(),true);
        $response->assertStatus(200);
    }
}
