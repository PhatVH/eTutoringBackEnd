<?php

use Illuminate\Database\Seeder;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'user_ID' => 1,
            'staff_name' => 'Staff1',
            'staff_email' => 'staff1@gmail.com',
            'staff_phone' => '0972222222'
        ]);
    }
}
