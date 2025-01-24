<?php

namespace Database\Seeders;

use App\Models\YearSemester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years=['First Year','Second Year','Thrid Year','Fourth Year'];
        $semester=['First Semester','Second Semester','Thrid Semester','Fourth Semester','Fifth Semester','Sixth Semester','Sevent Semester','Eight Semester'];
        foreach($years as $year){
            YearSemester::create([
                'batch_type_id'=>1,
                'title'=>$year
            ]);
        }

        foreach($semester as $sem){
            YearSemester::create([
                'batch_type_id'=>2,
                'title'=>$sem
            ]);
        }
    }
}
