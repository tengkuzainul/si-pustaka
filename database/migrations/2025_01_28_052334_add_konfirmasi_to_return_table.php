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
        Schema::table('return', function (Blueprint $table) {
            $table->enum('konfirmasi_pengembalian', ['Menunggu', 'Diterima'])
                ->default('Menunggu')
                ->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('return', function (Blueprint $table) {
            //
        });
    }
};
