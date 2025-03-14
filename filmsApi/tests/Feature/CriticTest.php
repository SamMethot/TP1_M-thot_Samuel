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
        $this->seed();
        $critic = Critic::factory()->create();
        $response = $this->delete('/api/critics/' . $critic->id);        
        $response->assertStatus(204);
    }

    public function testDeleteCriticShouldReturn500IfCriticDoesNotExist(): void
    {
        $this->seed();
        $response = $this->delete('/api/critics/199999999999999999');
        $response->assertStatus(500);
    }
}