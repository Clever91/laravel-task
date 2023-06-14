<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Score;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(random_int(2,6)), '.');
        $description = rtrim($this->faker->sentence(random_int(10,30)), '.');
        return [
            'title' => $title,
            'description' => $description,
            'category_id' => Category::find(random_int(1, 25)),
            'score_id' => Score::find(random_int(1,6)),
            'state' => 1
        ];
    }
}
