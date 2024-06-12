<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->decimal('total_harga', 10, 2);
            $table->string('bukti_transfer')->nullable();
            $table->string('status')->default(0); // Set default value to 0
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};