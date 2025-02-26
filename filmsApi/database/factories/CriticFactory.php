<?php

namespace Database\Factories;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Critic>
 */
class CriticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filmIds = Film::pluck('id')->toArray(); // Documentation : https://laravel.com/docs/11.x/collections#method-pluck
        $userIds = User::pluck('id')->toArray();

        $faker = Faker::create();
        return [
            'comment' =>$faker->text(10),
            'score' => $faker->numberBetween(1, 10),
            'created_at' => $faker->dateTimeThisYear(),
            'updated_at' => $faker->dateTimeThisYear(),
            'film_id' => $this->faker->randomElement($filmIds), // Documentation du randomElement : https://fakerphp.org/formatters/numbers-and-strings/#randomelement
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
