<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert
        (
            [
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            ],
        );

        DB::table('users')->insert
        (
            [
            'username' => 'hr_head',
            'password' => Hash::make('admin'),
            'role' => 'hr_head',
            ],
        );

        DB::table('users')->insert
        (
            [
            'username' => 'hr_assistant',
            'password' => Hash::make('admin'),
            'role' => 'hr_assistant',
            ],
        );


    }
}
