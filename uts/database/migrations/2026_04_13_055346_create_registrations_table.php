<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->string('jurusan');
            $table->string('universitas');
            $table->text('alasan');
            $table->string('no_hp');
            $table->string('ktm_path')->nullable(); // foto KTM
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
