<?php

use App\Tutor;
use Illuminate\Database\Seeder;

class TutorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutors')->insert([
            'user_ID' => 2,
            'tutor_name' => 'Tutor1',
            'tutor_phone' => '0961111111',
            'tutor_email' => 'tutor1@gmail.com'
        ]);
    }
}
