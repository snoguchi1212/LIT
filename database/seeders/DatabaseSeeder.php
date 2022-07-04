<?php

namespace Database\Seeders;

use App\Models\PrefectureCode;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Score;
use App\Models\Test;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                OwnerSeeder::class,
                StudentSeeder::class,
                TeacherSeeder::class,
                PrefectureCodeSeeder::class,
                // SchoolCodeSeeder::class,
            ]
            );

        Test::factory(20)->create();
        Score::factory(100)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
