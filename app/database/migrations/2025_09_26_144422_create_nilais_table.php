<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->string('kelas');     // redundan untuk memudahkan filter sesuai soal
            $table->string('mapel');     // Matematika / Bahasa
            $table->unsignedInteger('nilai'); // 0..100
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('nilais');
    }
};
