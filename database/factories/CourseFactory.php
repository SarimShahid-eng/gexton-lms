<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_title' => $this->faker->sentence(3),
            'course_description' => $this->faker->paragraph,
            'Duration' => $this->faker->numberBetween(2,48) . 'Weeks',
            'created_date' => now()->toDateString(),
            'session_year_id' => \App\Models\CustomSession::factory(), // make sure CustomSession factory exists
            'test_time' => $this->faker->time('H:i:s'), // in minutes
            'questions_limit' => $this->faker->numberBetween(10, 50),
        ];
    }
}
