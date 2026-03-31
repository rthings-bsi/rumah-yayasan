<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asramas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_asrama')->unique(); // e.g. RH01
            $table->string('nama_asrama');            // e.g. Rumah Harapan 01
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asramas');
    }
};
