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
        Schema::create('bukus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('gambar_buku')->nullable();
            $table->string('isbn', 150)->unique();
            $table->string('nama_buku', 150);
            $table->string('penerbit', 150);
            $table->date('tahun_terbit');
            $table->integer('stok_buku');
            $table->text('sinopsis');
            $table->timestamps();
            $table->unsignedBigInteger('kategori_buku_id');
            $table->foreign('kategori_buku_id')->references('id')->on('kategori_buku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
