<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationalLeasePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operational_lease_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lease_offers_id')->nullable()->unsigned();
            $table->foreign('lease_offers_id')->references('id')->on('lease_offers');
            $table->string('leaseprijs_per_maand');
            $table->string('km_per_jaar');
            $table->string('looptijd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operational_lease_prices');
    }
}
