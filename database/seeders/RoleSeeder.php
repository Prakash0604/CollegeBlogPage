<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=['Super Admin','Admin','Staff'];
        foreach ($roles as $item) {
            if (is_null(DB::table('roles')->where('title', $item)->select('id')->first())) {
            DB::table('roles')->insert([
               'title'=>$item
            ]);
            }
        }
    }
}
