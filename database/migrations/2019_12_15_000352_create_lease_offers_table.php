<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('uitvoering')->nullable();
            $table->string('images')->nullable();
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->string('kleur')->nullable();
            $table->string('inbegrepen')->nullable();
            $table->string('catalogusprijs')->nullable();
            $table->string('bijtelling')->nullable();
            $table->string('auto_segment')->nullable();
            $table->string('brandstof')->nullable();
            $table->string('carrosserie')->nullable();
            $table->string('aantal_deuren')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_offers');
    }
}
