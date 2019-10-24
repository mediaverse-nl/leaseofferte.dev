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
        DB::table('category')->insert([
            'id' => 1,
            'value' => 'Productie & Industrie',
        ]);

        DB::table('category')->insert([
            'id' => 2,
            'value' => 'Bouw & Grondverzet',
        ]);

        DB::table('category')->insert([
            'id' => 3,
            'value' => 'Trucks & Trailers',
        ]);

        DB::table('category')->insert([
            'id' => 4,
            'value' => 'Agrarisch & Tuinbouw',
        ]);

        DB::table('category')->insert([
            'id' => 5,
            'value' => 'ICT, beeld & geluid',
        ]);

        DB::table('category')->insert([
            'id' => 6,
            'value' => 'Medical',
        ]);

        DB::table('category')->insert([
            'id' => 7,
            'value' => 'Grafische equipment',
        ]);

        DB::table('category')->insert([
            'id' => 8,
            'value' => 'Auto & Bestelbus',
        ]);

        DB::table('category')->insert([
            'id' => 9,
            'value' => 'Food & AGF',
        ]);

        DB::table('category')->insert([
            'id' => 10,
            'value' => 'Intern transport & magazijn',
        ]);

        DB::table('category')->insert([
            'id' => 11,
            'value' => 'Kantoor / bedrijfsinventaris',
        ]);

        DB::table('category')->insert([
            'id' => 12,
            'value' => 'Afval & Recycling',
        ]);

        DB::table('category')->insert([
            'id' => 13,
            'value' => 'Bijzonder transport',
        ]);

        DB::table('category')->insert([
            'id' => 14,
            'value' => 'Diverse',
        ]);
    }
}
