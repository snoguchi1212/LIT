<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subjects')->insert([
            [
                'name' => '英語',
                'sort_order' => '1',
            ],
            [
                'name' => '数学',
                'sort_order' => '2',
            ],
            [
                'name' => '国語',
                'sort_order' => '3',
            ],
            [
                'name' => '理科',
                'sort_order' => '4',
            ],
            [
                'name' => '物理',
                'sort_order' => '5',
            ],
            [
                'name' => '化学',
                'sort_order' => '6',
            ],
            [
                'name' => '生物',
                'sort_order' => '7',
            ],
            [
                'name' => '物理',
                'sort_order' => '8',
            ],
            [
                'name' => '社会',
                'sort_order' => '9',
            ],
            [
                'name' => 'その他',
                'sort_order' => '10',
            ],
        ]);
    }
}
