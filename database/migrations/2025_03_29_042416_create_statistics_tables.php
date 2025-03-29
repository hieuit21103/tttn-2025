<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->integer('total_students');
            $table->integer('male_students');
            $table->integer('female_students');
            $table->integer('active_students');
            $table->integer('inactive_students');
            $table->integer('students_with_violations');
            $table->integer('students_with_fees');
            $table->date('report_date');
            $table->timestamps();
        });

        Schema::create('payment_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->decimal('total_revenue', 15, 2);
            $table->decimal('room_rental', 15, 2);
            $table->decimal('service_charges', 15, 2);
            $table->decimal('late_fees', 15, 2);
            $table->decimal('violation_fees', 15, 2);
            $table->integer('total_invoices');
            $table->integer('paid_invoices');
            $table->integer('unpaid_invoices');
            $table->decimal('total_unpaid_amount', 15, 2);
            $table->decimal('average_payment_amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_statistics');
        Schema::dropIfExists('student_statistics');
    }
};