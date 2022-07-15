<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class StudentTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++){

            // studentsとteachersテーブルのidカラムをランダムに並び替え、先頭の値を取得
            $set_student_id = Student::select('id')->inRandomOrder()->first()->id;

            $set_teacher_id = Teacher::select('id')->inRandomOrder()->first()->id;

            $set_subject_id = Subject::select('id')->inRandomOrder()->first()->id;

            // クエリビルダを利用し、上記のモデルから取得した値が、現在までの複合主キーと重複するかを確認
            $student_teacher = DB::table('student_teacher')
                            ->where([
                                ['student_id', '=', $set_student_id],
                                ['teacher_id', '=', $set_teacher_id],
                                ['subject_id', '=', $set_subject_id]
                            ])->get();

            // 上記のクエリビルダで取得したコレクションが空の場合、外部キーに上記のモデルから取得した値をセット
            if($student_teacher->isEmpty()){
                DB::table('student_teacher')->insert(
                    [
                        'student_id' => $set_student_id,
                        'teacher_id' => $set_teacher_id,
                        'subject_id' => $set_subject_id,
                    ]
                );
            }else{
                $i--;
            }
        }
    }
}
