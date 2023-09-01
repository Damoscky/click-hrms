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
        Schema::create('client_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('client_id');
            $table->string('phoneno')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contract_document')->nullable();
            $table->string('status')->nullable();
            $table->decimal('standard_hca', 15, 2)->nullable();
            $table->decimal('senior_hca', 15, 2)->nullable();
            $table->decimal('rgn', 15, 2)->nullable();
            $table->decimal('kitchen_assistant', 15, 2)->nullable();
            $table->decimal('laundry', 15, 2)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_records');
    }
};
