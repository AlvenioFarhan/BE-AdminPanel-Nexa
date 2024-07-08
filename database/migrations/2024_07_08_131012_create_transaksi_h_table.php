<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // database/migrations/xxxx_xx_xx_xxxxxx_create_transaksi_h_table.php
        Schema::create('transaksi_h', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('customers');
            $table->string('nomor_transaksi');
            $table->date('tanggal_transaksi');
            $table->decimal('total_transaksi', 15, 2);
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
        Schema::dropIfExists('transaksi_h');
    }
}
