<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'value' => 'auto operational lease',
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'value' => 'auto financial lease',
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'value' => 'trucks',
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'value' => 'bouw',
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'value' => 'landbouw',
        ]);

        DB::table('categories')->insert([
            'id' => 6,
            'value' => 'heftruck',
        ]);

        DB::table('categories')->insert([
            'id' => 7,
            'value' => 'machine',
        ]);
    }
}
