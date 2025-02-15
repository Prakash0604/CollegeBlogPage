<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (is_null(DB::table('form_permissions')->where('slug', 'dashboard')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Dashboard',
                    'slug' => 'dashboard',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }

        if (is_null(DB::table('form_permissions')->where('slug', 'post')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Post',
                    'slug' => 'post',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }

        if (is_null(DB::table('form_permissions')->where('slug', 'degree')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Degree',
                    'slug' => 'degree',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }

        if (is_null(DB::table('form_permissions')->where('slug', 'student')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Student',
                    'slug' => 'student',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }if (is_null(DB::table('form_permissions')->where('slug', 'syllabus-content')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Syllabus Content',
                    'slug' => 'syllabus-content',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }if (is_null(DB::table('form_permissions')->where('slug', 'event')->select('id')->first())) {
            DB::table('form_permissions')->insert(
                [
                    'formname' => 'Event',
                    'slug' => 'event',
                    'isinsert' => 'Y',
                    'isupdate' => 'Y',
                    'isedit' => 'Y',
                    'isdelete' => 'Y',
                    'role_id' => '1'
                ]
            );
        }
    }
}
