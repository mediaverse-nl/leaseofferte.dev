<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterLeaseOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operational_lease_prices', function (Blueprint $table) {
            $table->dropForeign(['lease_offers_id']);
            $table->foreign('lease_offers_id')
                ->references('id')
                ->on('lease_offers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('alter_lease_offers');
    }
}
