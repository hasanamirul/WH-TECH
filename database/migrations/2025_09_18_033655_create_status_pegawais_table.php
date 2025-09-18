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
        Schema::create('status_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pegawai_id')->constrained('jenis_pegawais')->cascadeOnDelete();
            $table->string('nama_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pegawais');
    }
};
