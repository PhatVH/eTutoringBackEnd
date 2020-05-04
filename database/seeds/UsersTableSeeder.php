<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'staff1',
            'password' => Hash::make('1'),
            'role' => 'staff',
            'country' => 'Vietnam'
        ]);

        DB::table('users')->insert([
            'username' => 'tutor1',
            'password' => Hash::make('1'),
            'role' => 'tutor',
            'country' => 'Vietnam'
        ]);

        DB::table('users')->insert([
            'username' => 'student1',
            'password' => Hash::make('1'),
            'role' => 'student',
            'country' => 'Vietnam'
        ]);
    }
}
