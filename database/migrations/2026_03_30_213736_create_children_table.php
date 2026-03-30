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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('full_name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->enum('category', ['fatherless', 'motherless', 'orphan', 'underprivileged']);
            $table->enum('enrollment_status', ['active', 'graduated', 'withdrawn']);
            $table->date('admission_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
