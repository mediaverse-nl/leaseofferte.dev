<?php

use Illuminate\Database\Seeder;

class LeaseOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


//        $table->string('meta_title');
//        $table->string('meta_description');
//        $table->string('title');
//        $table->string('uitvoering')->nullable();
//        $table->string('description')->nullable();
//        $table->string('images')->nullable();
//        $table->string('merk')->nullable();
//        $table->string('type')->nullable();
//        $table->string('kleur')->nullable();
////            $table->string('extra_opties')->nullable();
////            $table->string('dealer')->nullable();
//        $table->string('inbegrepen')->nullable();
//        $table->string('kilometrage')->nullable();
//        $table->string('looptijd')->nullable();
////            $table->string('winterbanden')->nullable();
//        $table->string('catalogusprijs')->nullable();
//        $table->string('bijtelling')->nullable();
//
        $columns = array([
            'title' => 'Peugeot 108',
            'uitvoering' => 'Access 1.0 e-VTi 68 pk Benzine 5 deurs',
            'description' => $faker->text,
            'merk' => 'Peugeot',
            'type' => 'Access 1.0 e-VTi 68 pk Benzine 5 deurs',
            'kleur' => 'diverse kleuren',
            'inbegrepen' => "* Vervangend vervoer na 24 uur bij schade of onderhoud<br>",
            'kilometrage' => '20000',
            'looptijd' => '24,36,48',
            'catalogusprijs' => '11300',
            'bijtelling' => '22',
        ],[
            'title' => 'Volkswagen Up',
            'uitvoering' => 'Take Up! 1.0 benzine 44 kW BlueMotion 5 deurs',
            'description' => $faker->text,
            'merk' => 'Volkswagen',
            'type' => 'Up!',
            'kleur' => 'diverse kleuren',
            'inbegrepen' => "* Vervangend vervoer na 24 uur bij schade of onderhoud<br>",
            'kilometrage' => '20000',
            'looptijd' => '24,36,48',
            'catalogusprijs' => '11060',
            'bijtelling' => '22',
        ],[
            'title' => 'SEAT Leon',
            'uitvoering' => '1.0 EcoTSI Reference Benzine 5 deurs',
            'description' => $faker->text,
            'merk' => 'SEAT',
            'type' => 'Leon',
            'kleur' => 'diverse kleuren',
            'inbegrepen' => "* Vervangend vervoer na 24 uur bij schade of onderhoud<br>",
            'kilometrage' => '20000',
            'looptijd' => '24,36,48',
            'catalogusprijs' => '21110',
            'bijtelling' => '22',
        ],[
            'title' => 'Audi A1 Sportback',
            'uitvoering' => '1.0 TFSI benzine 70 kW 5 deurs',
            'description' => $faker->text,
            'merk' => 'Audi',
            'type' => 'A1 Sportback',
            'kleur' => 'diverse kleuren',
            'inbegrepen' => "* Vervangend vervoer na 24 uur bij schade of onderhoud<br>",
            'kilometrage' => '20000',
            'looptijd' => '24,36,48',
            'catalogusprijs' => '20490',
            'bijtelling' => '22',
        ]);

        foreach ($columns as $column)
            DB::table('lease_offers')->insert($column);
    }
}
