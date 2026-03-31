<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->foreignId('asrama_id')
                  ->nullable()
                  ->after('admission_date')
                  ->constrained('asramas')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropForeign(['asrama_id']);
            $table->dropColumn('asrama_id');
        });
    }
};
