<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dormitory_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->unique();
            $table->string('fullname');
            $table->enum('gender', ['Nam', 'Nữ']);
            $table->date('birthdate');
            $table->string('class');
            $table->string('id_number')->unique();
            $table->string('personal_phone');
            $table->string('family_phone');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('id_front_path');
            $table->string('id_back_path');
            $table->enum('status', ['pending', 'approved', 'activated', 'rejected'])->default('pending');
            $table->string('activation_token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dormitory_registrations');
    }
};
