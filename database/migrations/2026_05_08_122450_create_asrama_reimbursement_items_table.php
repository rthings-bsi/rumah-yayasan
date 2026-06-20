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
        Schema::create('asrama_reimbursement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_report_id')->constrained('asrama_expense_reports')->onDelete('cascade');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asrama_reimbursement_items');
    }
};
