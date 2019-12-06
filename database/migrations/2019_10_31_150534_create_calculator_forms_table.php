<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculatorFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculator_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');
            //calculator
            $table->integer('aanschafprijs');
            $table->integer('aanbetaling');
            $table->integer('slottermijn');
            $table->integer('looptijd');
            //object info
            $table->string('merk');
            $table->string('model_type');
            $table->string('kenteken')->nullable();
            $table->integer('bouwjaar');
            $table->integer('stand');
            //overige extra's
            $table->string('omschrijving');
            $table->string('link_leverancier')->nullable();
            //bedrijfsgegevens
            $table->string('bedrijfsnaam');
            $table->string('voor_en_achternaam');
            $table->string('kamer_van_koophandel_nummer');
            $table->string('adres');
            $table->string('postcode');
            $table->string('woonplaats');
            $table->string('aantal_eigenaren');
            $table->string('emailadres');
            $table->string('mobiel_telefoonnummer');
            $table->string('telefoonnummer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculator_forms');
    }
}
