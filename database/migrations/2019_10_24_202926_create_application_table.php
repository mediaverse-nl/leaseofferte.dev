<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solution_id')->nullable()->unsigned();
            $table->foreign('solution_id')->references('id')->on('solutions');
//            $table->string('id');

            $table->string('merk');
            $table->string('type');
            $table->string('kenteken')->nullable();
            $table->string('bouwjaar');
            $table->string('leverancier');

            $table->integer('aanschaf');
            $table->integer('aanbetaling');
            $table->integer('slottermijn');
            $table->integer('looptijd');

            $table->string('bedrijfsnaam')->nullable();
            $table->string('kvk')->nullable();
            $table->string('tav');
            $table->string('geboortedatum');
            $table->string('email');
            $table->string('telefoonnummer')->nullable();

            $table->string('files')->nullable();

            $table->string('status')->nullable();
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
        Schema::dropIfExists('application');
    }
}
