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
            'username' => 'markv',
            'password' => Hash::make('markadmin'),
            'role' => 'admin',
            ],
        );

        DB::table('users')->insert
        (
            [
            'username' => 'hr_head',
            'password' => Hash::make('markadmin'),
            'role' => 'hr_head',
            ],
        );

        DB::table('users')->insert
        (
            [
            'username' => 'hr_assistant',
            'password' => Hash::make('markadmin'),
            'role' => 'hr_assistant',
            ],
        );

    }
}
