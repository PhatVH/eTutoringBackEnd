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
        factory(Tutor::class, 20)->create();
    }
}
