<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->primary(['student_id', 'class_id']);
            $table->timestamps();
        });

        Schema::create('student_courses', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->primary(['student_id', 'course_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_classes');
        Schema::dropIfExists('student_courses');
    }
};