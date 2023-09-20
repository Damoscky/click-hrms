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
        Schema::create('employee_reference_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_references_id');
            $table->string('email')->nullable();
            $table->date('date_of_employment')->nullable();
            $table->string('position')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('reason_for_leaving')->nullable();
            $table->string('name_of_referee')->nullable();
            $table->string('name_of_organization')->nullable();
            $table->string('referee_position')->nullable();
            $table->string('referee_email')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('teamwork')->nullable();
            $table->string('honesty')->nullable();
            $table->string('observation')->nullable();
            $table->string('appearance')->nullable();
            $table->string('communication')->nullable();
            $table->string('altitude')->nullable();
            $table->string('feedback')->nullable();
            $table->string('signed_name')->nullable();
            $table->date('signed_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employee_references_id')->references('id')->on('employee_references')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_reference_responses');
    }
};
