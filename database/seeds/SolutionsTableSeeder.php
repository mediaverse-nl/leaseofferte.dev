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
            'category_id' => 1,
            'title' => 'CNC-Metaalbewerkingsmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Garage equipment',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Houtbewerkingsmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Kunststofbewerkingmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Laser Graveermachine',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Luchtzuivering apparatuur',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Meet, weeg en regelapparatuur',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Robotica / Robotisering',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Textielmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 1,
            'title' => 'Verpakkingsmachine',
            'description' => $faker->text,
        ],

        //2
        [
            'category_id' => 2,
            'title' => 'Graafmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Betonmixer / betonpomp',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Bulldozer ',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Generator / aggregaat',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Graaf / laad combinatie',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Hijskraan / hoogwerker',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Knik / dumper',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Meetinstrumenten',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Schranklader / knikmops',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Verreiker',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Wegenbouw / asfalteermachine',
            'description' => $faker->text,
        ],[
            'category_id' => 2,
            'title' => 'Wiellader / shovel',
            'description' => $faker->text,
        ],

        //3
        [
            'category_id' => 3,
            'title' => 'Oplegger / trailer',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Aanhangwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Autotransporter',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Kipper / kipwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Schaarlift / laadarm / kraan',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Truck / trekker / vrachtwagen',
            'description' => $faker->text,
        ],[
            'category_id' => 3,
            'title' => 'Verkoopwagen / marktwagen',
            'description' => $faker->text,
        ],

        //4
        [
            'category_id' => 4,
            'title' => 'Aardappel / bietenrooier ',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Balenpers / wikkelaar',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Bloemenverpakkingsmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Eg / ploeg / zaaimachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Hakselaar / houtkloof',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Maaimachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Maisdorser',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Melkinstallatie / melktank',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Oogstmachine',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Tractor',
            'description' => $faker->text,
        ],[
            'category_id' => 4,
            'title' => 'Veldspuit',
            'description' => $faker->text,
        ],

        //5
        [
            'category_id' => 5,
            'title' => 'Computer-laptop-scherm',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Beamer / projector',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Foto / video',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Printer / copier',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => 'Server',
            'description' => $faker->text,
        ],[
            'category_id' => 5,
            'title' => "TV's / AV / beeld en geluid",
            'description' => $faker->text,
        ],

        //6
        [
            'category_id' => 6,
            'title' => "MRI / CT scan",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Laboratorium apparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Laser / scan apparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Medische praktijkinrichting",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Microscoop",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Overige medische apparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Radiologie apparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 6,
            'title' => "Tandartsstoel / praktijkinrichting",
            'description' => $faker->text,
        ],

        //7
        [
            'category_id' => 7,
            'title' => "Digitale printer",
            'description' => $faker->text,
        ],[
            'category_id' => 7,
            'title' => "Drukpers",
            'description' => $faker->text,
        ],[
            'category_id' => 7,
            'title' => "Post / after press",
            'description' => $faker->text,
        ],[
            'category_id' => 7,
            'title' => "Prepress",
            'description' => $faker->text,
        ],

        //8
        [
            'category_id' => 8,
            'title' => "Bestelwagen tot 3,5 ton",
            'description' => $faker->text,
        ],[
            'category_id' => 8,
            'title' => "Personenauto",
            'description' => $faker->text,
        ],

        //9
        [
            'category_id' => 9,
            'title' => "AGF-Productielijn",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Koelmeubel",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Meng / kneedmachine",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Oven",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Professionele keuken",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Snij / doseermachine",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Voedselverwerkende machine",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Vulmachine",
            'description' => $faker->text,
        ],[
            'category_id' => 9,
            'title' => "Weegmachine",
            'description' => $faker->text,
        ],

        //10
        [
            'category_id' => 10,
            'title' => "Magazijnstellingen",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "AGV-systeem",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Bandtransportinstallaties / conveyor",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Bovenloopkraan",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Container",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Heftruck",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Reachtruck",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Scan / Order pick equipment",
            'description' => $faker->text,
        ],[
            'category_id' => 10,
            'title' => "Wikkelmachine",
            'description' => $faker->text,
        ],

        //11
        [
            'category_id' => 11,
            'title' => "Alarm systeem / toegangscontrole",
            'description' => $faker->text,
        ],[
            'category_id' => 11,
            'title' => "Kantoormeubilair / hotelbedden",
            'description' => $faker->text,
        ],[
            'category_id' => 11,
            'title' => "Kassa",
            'description' => $faker->text,
        ],[
            'category_id' => 11,
            'title' => "Kassa",
            'description' => $faker->text,
        ],[
            'category_id' => 11,
            'title' => "Telefooncentrale",
            'description' => $faker->text,
        ],[
            'category_id' => 11,
            'title' => "Vendingmachine",
            'description' => $faker->text,
        ],

        //12
        [
            'category_id' => 12,
            'title' => "Breker",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Recycling machine",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Reiniging / veegmachine",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Schrobzuigmachine",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Shredder / pers",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Vuilniswagen",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "WKK",
            'description' => $faker->text,
        ],[
            'category_id' => 12,
            'title' => "Zeef",
            'description' => $faker->text,
        ],

        [
            'category_id' => 13,
            'title' => "Ambulance",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Autobus / touringcar",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Bergingsvoertuig",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Brandweerwagen",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Quad / buggy / trike",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Rouwvervoer",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Veevervoer",
            'description' => $faker->text,
        ],[
            'category_id' => 13,
            'title' => "Verhuiswagen",
            'description' => $faker->text,
        ],

        //14
        [
            'category_id' => 14,
            'title' => "Fitness apparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "Gas/water/electr. productie",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "Infraroodapparatuur",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "LED-verlichting",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "Mobiele unit",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "Vaartuig / werkboot",
            'description' => $faker->text,
        ],[
            'category_id' => 14,
            'title' => "Zonnepanelen",
            'description' => $faker->text,
        ],

        );

        foreach ($columns as $column)
            DB::table('solutions')->insert($column);
    }
}
