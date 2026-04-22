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
        Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siswa yang pinjam
        $table->foreignId('buku_id')->constrained()->onDelete('cascade'); // Buku yang dipinjam
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali')->nullable(); // Tanggal seharusnya kembali
        $table->date('tanggal_nyata_kembali')->nullable();
        $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');
        $table->decimal('total_denda', 10, 2)->default(0); // Total denda jika terlambat
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
