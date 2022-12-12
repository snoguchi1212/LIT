<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

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
        $set_student_id = Student::select('id')->inRandomOrder()->first()->id;
        $titles = ['1学期中間試験', '1学期期末試験', '2学期中間試験', '2学期期末試験', '学年末試験', '○○模試'];
        $set_title = $titles[array_rand($titles, 1)];

        return [
            'student_id' => $set_student_id,
            'title' => $set_title,
            'start_date' => $scheduled_date->format('Y-m-d'),
            'end_date' => $scheduled_date->modify(strval(random_int(0,5)).'day')->format('Y-m-d'),
        ];
    }
}
