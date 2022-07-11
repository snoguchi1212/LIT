<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $scheduled_date = $this->faker->dateTimeBetween('-2 years', 'now', 'Asia/Tokyo');

        return [
            'student_id' => $this->faker->numberBetween(1, 4),
            'title' => $this->faker->text(16),
            'start_date' => $scheduled_date->format('Y-m-d'),
            'end_date' => $scheduled_date->modify(strval(random_int(0,5)).'day')->format('Y-m-d'),
        ];
    }
}
