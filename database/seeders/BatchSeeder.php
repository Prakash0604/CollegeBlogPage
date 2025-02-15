<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = ["2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022", "2023", "2024", "2025"];
        foreach ($batches as $batch) {
            Batch::create([
                'title' => $batch,
            ]);
        }

        foreach ($batches as $batch) {
            if (is_null(DB::table('batches')->where('title', $batch)->select('id')->first())) {
            DB::table('batches')->insert([
                'title' => $batch,
            ]);
            }
        }
    }
}
