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
        Schema::create('employee_timesheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('client_id');
            $table->boolean('clock_in')->default(false);
            $table->boolean('clock_out')->default(false);
            $table->date('clock_in_date')->nullable();
            $table->date('clock_out_date')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('status')->default("Pending")->comment('Pending, Approved, Cancelled');
            $table->string('client_comment')->nullable();
            $table->string('client_rating')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_timesheets');
    }
};
