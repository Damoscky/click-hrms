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
        Schema::create('employee_certifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('document_type')->nullable();
            $table->string('document_name')->nullable();
            $table->string('document_extension')->nullable();
            $table->string('size')->nullable();
            $table->string('document_mime')->nullable();
            $table->timestamp('issued_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->mediumText('file_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_certifications');
    }
};
