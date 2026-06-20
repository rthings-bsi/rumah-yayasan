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
        Schema::create('asrama_expense_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asrama_id')->constrained()->onDelete('cascade');
            $table->integer('bulan'); // 1-12
            $table->integer('tahun');
            $table->enum('status', ['draft', 'pending', 'finance_approved', 'director_approved', 'rejected'])->default('draft');
            $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->foreignId('finance_approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('finance_approved_at')->nullable();
            $table->text('finance_notes')->nullable();
            $table->foreignId('director_approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('director_approved_at')->nullable();
            $table->text('director_notes')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->decimal('total_pengeluaran', 15, 2)->default(0);
            $table->decimal('total_reimbursement', 15, 2)->default(0);
            $table->timestamps();
            
            // Unique constraint: one report per asrama per month
            $table->unique(['asrama_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asrama_expense_reports');
    }
};
