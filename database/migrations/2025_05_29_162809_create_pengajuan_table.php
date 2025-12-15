<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id(); // Atau gunakan NID sebagai primary key jika unik
            $table->string('nid')->unique(); // Nomor Identitas
            // $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Opsional: jika pengajuan terikat ke user login
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon');
            $table->string('email');
            $table->text('alamat');
            $table->string('dusun'); // Tambahan kolom dusun
            $table->string('ktp_path')->nullable(); // Path ke file KTP
            $table->string('kk_path')->nullable();  // Path ke file KK
            
            // Kolom tambahan dari model Pengajuan Anda
            $table->decimal('nominal', 15, 2)->nullable();
            $table->string('norek')->nullable();
            $table->string('pemilik_rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->text('tujuan_pendanaan')->nullable();
            $table->string('proposal_path')->nullable();
            $table->boolean('setuju')->default(false); // Untuk persetujuan syarat & ketentuan
            $table->string('status')->default('pending'); // Misal: pending, approved, rejected
            $table->date('tgl_pengajuan')->nullable();
            $table->date('tgl_pencairan')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->integer('tenor')->nullable(); // dalam bulan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};