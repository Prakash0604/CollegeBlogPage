<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $degrees=['Bachelor in Computer Application','Bachelor of Arts','Bachelor of Business Administration','Bachelor of Fine Arts','Bachelor of Business Administration','Eleven','Twelve','Bachelor of Science in Software Engineering '];
        foreach($degrees as $degree){
            Degree::create([
                'title'=>$degree
            ]);
        }
    }
}
