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
            $table->decimal('previous_reading', 10, 2)->nullable()->comment('Số chỉ số trước');
            $table->decimal('current_reading', 10, 2)->nullable()->comment('Số chỉ số hiện tại');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};