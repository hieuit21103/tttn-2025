<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('capacity');
            $table->decimal('monthly_price', 10, 2);
            $table->timestamps();
        });
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade');
            $table->integer('capacity');
            $table->decimal('monthly_price', 10, 2);
            $table->integer('current_occupancy')->default(0);
            $table->enum('status', ['available', 'full', 'maintenance'])->default('available');
            $table->timestamps();
        }); 
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
