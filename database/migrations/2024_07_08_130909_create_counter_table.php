<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // database/migrations/xxxx_xx_xx_xxxxxx_create_counter_table.php
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('counter');
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
        Schema::dropIfExists('counter');
    }
}
