<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextTable extends Migration
{
    public function up()
    {
        Schema::create('text', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key_name');
            $table->enum('text_type', ['textarea', 'richtext', 'text']);
            $table->string('option', 1000)->nullable();
            $table->longText('text',  80000)->nullable();
            $table->unique(['key_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text');
    }
}
