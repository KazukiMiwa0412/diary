<?php

use Illuminate\Database\Seeder;
use App\Diary;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Diary::class, 10)->create();
    }
}
