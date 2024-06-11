<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TargetPenelitian;

class TargetPenelitianSeeder extends Seeder
{
    public function run()
    {
        $years = range(2024, 2044);

        foreach ($years as $year) {
            TargetPenelitian::create([
                'tahun' => $year,
                'target' => 10,
            ]);
        }
    }
}
