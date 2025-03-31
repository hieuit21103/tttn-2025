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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->boolean('has_chronic_disease')->default(false);
            $table->text('chronic_disease_notes')->nullable();
            $table->boolean('has_allergies')->default(false);
            $table->text('allergies_notes')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('emergency_contact_name');
            $table->text('emergency_contact_relationship');
            $table->string('emergency_contact_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
