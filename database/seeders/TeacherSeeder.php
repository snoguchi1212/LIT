<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'family_name' => '講師',
                'first_name' => '一郎',
                'family_name_kana' => 'コウシ',
                'first_name_kana' => 'イチロウ',
                'sex' => 0,
                'email' => 'teacher1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '講師',
                'first_name' => '二郎',
                'family_name_kana' => 'コウシ',
                'first_name_kana' => 'ジロウ',
                'sex' => 1,
                'email' => 'teacher2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '講師',
                'first_name' => '花子',
                'family_name_kana' => 'コウシ',
                'first_name_kana' => 'ハナコ',
                'sex' => 1,
                'email' => 'teacher3@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2022/06/30 11:11:11',
            ],
        ]
    );
    }
}
