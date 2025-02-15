<?php

namespace Database\Seeders;

use App\Models\BatchType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batchType=['Year','Semester'];
        foreach($batchType as $type){
            BatchType::create([
                'title'=>$type
            ]);
        }

    }
}
