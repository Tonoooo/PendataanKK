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
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained('keluargas')->onDelete('cascade');

            // --- Kolom Data Sesuai KK Asli ---
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('jenis_pekerjaan');
            $table->string('golongan_darah', 3)->nullable();
            $table->string('status_perkawinan');
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('status_hubungan_dalam_keluarga');
            $table->string('kewarganegaraan');
            $table->string('nama_ayah');
            $table->string('nama_ibu');

            // --- Kolom Data Tambahan (Custom) ---
            $table->unsignedBigInteger('penghasilan_per_bulan')->nullable();
            $table->text('skill_keahlian')->nullable();
            $table->string('email')->nullable()->unique();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};
