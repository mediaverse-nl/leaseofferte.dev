<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $columns = array([
            'title' => 'voorbeeld 1',
            'description' => $faker->text,
        ],[
            'title' => 'voorbeeld 2',
            'description' => $faker->text,
        ]);

        foreach ($columns as $column)
            DB::table('faq')->insert($column);
    }
}
