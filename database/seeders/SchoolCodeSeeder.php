<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolCode;

class SchoolCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("SchoolCodeCSVの読み込み...");

        $fileNames = ['SchoolCode_1_22_05.csv', 'SchoolCode_2_22_05.csv', 'SchoolCode_3_22_05.csv'];

        foreach ($fileNames as $fileName ) {

            $schoolCodeSplFileObject = new \SplFileObject('/var/www/html/public/csv/' . $fileName);
            $schoolCodeSplFileObject->setFlags(
                \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
            );

            $count = 0;
            foreach ($schoolCodeSplFileObject as $key => $row) {
                if ($key === 0) {
                    continue;
                }

                SchoolCode::create([
                    'school_code' => trim($row[0]),
                    'kind_of_school' => trim($row[1]),
                    'prefecture_code' => trim($row[2]),
                    'name' => trim($row[5]),
                ]);
                $count++;
            }
        }
    }
}
