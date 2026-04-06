<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable(); // nullable berarti boleh kosong (opsional)
            $table->string('kode_barang')->unique(); // unique berarti kode tidak boleh ada yang sama
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('satuan');
            $table->integer('stok');
            $table->integer('harga');
            $table->timestamps(); // otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
