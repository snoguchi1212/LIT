<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrefectureCode;

class PrefectureCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("都道府県の作成を開始します...");

        $this->command->info(asset("csv/LIT_logo.png"));

        $prefectureCodeSplFileObject = new \SplFileObject(asset("csv/LIT_logo.png"));
        $prefectureCodeSplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $count = 0;
        foreach ($prefectureCodeSplFileObject as $key => $row) {
            if ($key === 0) {
                continue;
            }

            PrefectureCode::create([
                'prefecture_code' => trim($row[0]),
                'name' => trim($row[1]),
            ]);
            $count++;
        }

    }
}
