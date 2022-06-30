<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert(
        [
            [
                'family_name' => '山田',
                'last_name' => '太郎',
                'family_name_kana' => 'ヤマダ',
                'last_name_kana' => 'タロウ',
                'sex' => 0,
                'email' => 'student1@test.com',
                'password' => Hash::make('password123'),
                'grade' => 5,
                'ls_choice' => 0,
                'school_code' => 'D126210000060', //西京高校
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '鈴木',
                'last_name' => '花子',
                'family_name_kana' => 'スズキ',
                'last_name_kana' => 'ハナコ',
                'sex' => 1,
                'email' => 'student2@test.com',
                'password' => Hash::make('password123'),
                'grade' => 6,
                'ls_choice' => 1,
                'school_code' => 'D126210000079', //西京高校
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '佐藤',
                'last_name' => '二郎',
                'family_name_kana' => 'サトウ',
                'last_name_kana' => 'ジロウ',
                'sex' => 0,
                'email' => 'student3@test.com',
                'password' => Hash::make('password123'),
                'grade' => 2,
                'ls_choice' => 1,
                'school_code' => 'C126210001533', //西京中学
                'created_at' => '2022/06/30 11:11:11',
            ],
            [
                'family_name' => '高橋',
                'last_name' => '良子',
                'family_name_kana' => 'タカハシ',
                'last_name_kana' => 'リョウコ',
                'sex' => 1,
                'email' => 'student4@test.com',
                'password' => Hash::make('password123'),
                'grade' => 1,
                'ls_choice' => 1,
                'school_code' => 'C126310000024', //同志社中学
                'created_at' => '2022/06/30 11:11:11',
            ],
        ]
    );

    }
}
