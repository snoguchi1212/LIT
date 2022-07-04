<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Test;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'test_id' => $this->faker->numberBetween(1, 20),
            'subject_id' => $this->faker->numberBetween(1, 10),
            'score' => $this->faker->numberBetween(0, 100),
            'school_ranking' => $this->faker->numberBetween(1, 50),
            'school_people' => $this->faker->numberBetween(50, 100),
            'national_ranking' => $this->faker->numberBetween(1, 150),
            'national_people' => $this->faker->numberBetween(150, 300),
            'deviation_value' => $this->faker->randomFloat(2, 30, 80),
            'average_score' => $this->faker->randomFloat(1, 0, 100),
        ];
    }
}
