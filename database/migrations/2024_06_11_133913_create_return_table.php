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
        Schema::create('return', function (Blueprint $table) {
            $table->id();
            $table->string('no_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->integer('denda')->nullable();
            $table->unsignedBigInteger('peminjaman_id');
            $table->timestamps();
            $table->foreign('peminjaman_id')->references('id')->on('lends')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return');
    }
};
