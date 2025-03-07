<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriticFilmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetInfoFromFilmWithCriticsShouldReturn404WhenNull(): void
    {
        $response = $this->get('/api/films/1/critics');
        $response->assertStatus(404);
    }
}
