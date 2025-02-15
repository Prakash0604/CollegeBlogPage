<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Dashboard', 'dashboard', 'bi bi-speedometer2'],
            ['Post', 'post', 'bi bi-newspaper'],
            ['Degree', 'faculty', 'bi bi-house-gear-fill'],
            ['Student', 'student', 'bi bi-person-square'],
            ['Syllabus Content', 'syllabus-content', 'bi bi-journal-check'],
            ['Event', 'event', 'bi bi-journal-check'],

        ];

        foreach ($data as $item) {
            if (is_null(DB::table('menus')->where('title', $item[0])->select('id')->first())) {
            DB::table('menus')->insert([
                'title' => $item[0],
                'redirect' => $item[1],
                'icon' => $item[2],
            ]);
            }
        }
    }
}
