<?php

namespace Database\Factories;

use App\Http\Controllers\algorithme;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'likes_count' => $this->faker->numberBetween($min = 0, $max = 1000000),
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->sentence(50),
        ];
    }


}
