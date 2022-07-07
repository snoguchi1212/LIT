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
                'email' => 'teacher1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '講師',
                'first_name' => '二郎',
                'family_name_kana' => 'コウシ',
                'first_name_kana' => 'ジロウ',
                'email' => 'teacher2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => '2022/06/30 11:11:11',
            ],
        ]
    );
    }
}
