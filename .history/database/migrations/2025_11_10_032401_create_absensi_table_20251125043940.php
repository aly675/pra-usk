<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswa')->onDelete('cascade')->onupdate('cascade');
            $table->foreignId('id_guru')->constrained('guru')->onDelete('cascade')->onupdate('cascade');
            $table->enum('status_kehadiran', ['hadir', 'sakit', 'izin', 'alfa']);
            $table->text('alasan')->nullable();
            $table->date('tanggal_absensi')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
