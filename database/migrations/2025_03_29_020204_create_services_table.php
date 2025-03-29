<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->decimal('price_per_unit', 10, 2);
            $table->enum('type', ['metered', 'fixed']);
            $table->timestamps();
        });

        Schema::create('metered_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->decimal('previous_reading', 10, 2);
            $table->decimal('current_reading', 10, 2);
            $table->decimal('consumption', 10, 2);
            $table->date('reading_date');
            $table->timestamps();
        });

        Schema::create('fixed_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('metered_services');
        Schema::dropIfExists('fixed_services');
    }
};