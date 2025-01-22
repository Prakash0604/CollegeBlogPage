<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name'=>'Super Admin',
            'email'=>'admin@gmail.com',
            'password'=>'admin@123',
            'role'=>'Admin'
        ]);
    }
}
