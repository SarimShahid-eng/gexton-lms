<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=CustomSession>
 */
class CustomSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_year' => $this->faker->year,
            'created_date' => now(),
            'is_selected' => 0,
        ];
    }
      // Define custom states for each record
    public function session2018()
    {
        return $this->state([
            'id' => 1,
            'session_year' => '2018',
            'created_date' => '2018-05-30 12:20:01',
            'is_selected' => 0,
        ]);
    }

    public function session2019()
    {
        return $this->state([
            'id' => 9,
            'session_year' => '2019',
            'created_date' => '2018-06-08 17:45:22',
            'is_selected' => 0,
        ]);
    }

    public function session2020()
    {
        return $this->state([
            'id' => 10,
            'session_year' => '2020',
            'created_date' => '2018-06-29 14:23:56',
            'is_selected' => 0,
        ]);
    }

    public function session2021()
    {
        return $this->state([
            'id' => 11,
            'session_year' => '2021',
            'created_date' => '2018-07-23 23:44:51',
            'is_selected' => 0,
        ]);
    }

    public function session2022()
    {
        return $this->state([
            'id' => 12,
            'session_year' => '2022',
            'created_date' => '2018-07-24 15:20:51',
            'is_selected' => 0,
        ]);
    }

    public function session2025()
    {
        return $this->state([
            'id' => 13,
            'session_year' => '2023',
            'created_date' => '2022-05-20 14:28:27',
            'is_selected' => 0,
        ]);
    }
    // }
}
