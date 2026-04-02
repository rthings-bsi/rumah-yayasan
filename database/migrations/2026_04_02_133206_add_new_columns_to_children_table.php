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
        Schema::table('children', function (Blueprint $table) {
            $table->string('nik', 16)->nullable()->after('full_name');
            $table->string('no_kk', 16)->nullable()->after('nik');
            $table->text('address')->nullable()->after('no_kk');
            $table->string('father_name')->nullable()->after('address');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->enum('grade', ['A', 'B'])->nullable()->after('mother_name');
            $table->enum('education_level', ['BS', 'TK', 'SD', 'SMP', 'SMA'])->nullable()->after('grade');
            $table->string('class_level')->nullable()->after('education_level');
            $table->string('recommended_by')->nullable()->after('class_level');
            $table->string('parent_phone_number', 15)->nullable()->after('recommended_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'no_kk',
                'address',
                'father_name',
                'mother_name',
                'grade',
                'education_level',
                'class_level',
                'recommended_by',
                'parent_phone_number',
            ]);
        });
    }
};
