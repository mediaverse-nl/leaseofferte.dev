<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolutionsTableSeeder extends Seeder
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
            'category_id' => 4,
            'title' => 'Graafmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Mini graafmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Bulldozer',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Hoogwerker',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Mobiele hijskraan',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Kipper dumper',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Verreiker',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Graaf laadcombinatie',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Bouwlift',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Wegenbouw asfalteermachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Wiellader shovel',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Betonmixer',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Trekker',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Oplegger',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Bakwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Vrachtwagen met laadbak',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Vrachtwagencombinatie',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Kipper-dumper',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Aanhanger',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Container',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Mixer',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Touringcar',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Bus of stadsbus',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Dubbeldekker bus',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Veegwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Mobiele recyclingmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Verkoopwagen-marktwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Tractor',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Aardappelrooier',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Maaimachine',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Combine',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Balenpers/balenwikkelaar',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Bietenrooier',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Bloemverpakkingsmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Ploeg/grondbewerkingsmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Hakselaar',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Maisdorser',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Irrigatiemachine',
            'description' => $faker->text,
        ]);

        foreach ($columns as $column)
            DB::table('solutions')->insert($column);
    }
}
