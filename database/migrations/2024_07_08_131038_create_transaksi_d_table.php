<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_xx_xx_xxxxxx_create_transaksi_d_table.php
        Schema::create('transaksi_d', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi_h')->constrained('transaksi_h');
            $table->string('kd_barang');
            $table->string('nama_barang');
            $table->integer('qty');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_d');
    }
};
