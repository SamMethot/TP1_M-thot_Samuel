<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;


class CriticFilmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetInfoFromFilmWithCritics(): void
    {
        $this->seed();
        $response = $this->get('/api/films/1/critics');
        $response->assertStatus(200);
    }
}
