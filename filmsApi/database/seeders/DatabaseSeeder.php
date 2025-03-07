<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Critic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            Critic::factory(30)->create(['user_id' => $user->id]);
        }
        
        $this->call([
            LanguageSeeder::class,
            FilmSeeder::class,
            ActorSeeder::class,
            ActorFilmSeeder::class
        ]);
    }
}
