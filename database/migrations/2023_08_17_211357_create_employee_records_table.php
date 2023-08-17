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
        Schema::create('employee_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id');
            $table->string('employee_id');
            $table->timestamp('resumption_date');
            $table->timestamp('date_of_birth')->nullable();
            $table->string('phoneno')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('id_card_type')->nullable();
            $table->string('id_number')->nullable();
            $table->mediumText('id_image')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_records');
    }
};
