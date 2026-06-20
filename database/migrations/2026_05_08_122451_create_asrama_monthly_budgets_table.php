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
        Schema::create('asrama_monthly_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asrama_id')->constrained()->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('jumlah_anggaran', 15, 2);
            $table->timestamps();
            
            $table->unique(['asrama_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asrama_monthly_budgets');
    }
};
