<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'student_ID' => 'GCH00001',
            'user_ID' => 3,
            'student_name' => 'Student1',
            'student_email' => 'student1@gmail.com',
            'student_phone' => '0983333333'
        ]);
    }
}
