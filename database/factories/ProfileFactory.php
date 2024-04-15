<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'followers_count' => $this->faker->numberBetween($min = 0, $max = 1000000),
            'language' => $this->faker->languageCode(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'age' => $this->faker->numberBetween($min = 18, $max = 45),
        ];
    }


}
