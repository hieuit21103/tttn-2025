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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->unique();
            $table->string('fullname');
            $table->enum('gender', ['Nam', 'Nữ']);
            $table->string('faculty_id');
            $table->string('class_id');
            $table->date('birthdate');
            $table->string('id_number');
            $table->string('personal_phone');
            $table->string('family_phone');
            $table->text('address');
            $table->string('email')->unique();
            $table->string('id_front_path');
            $table->string('id_back_path');
            $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('set null');
            $table->timestamp('registered_at');
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
