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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("gender")->nullable();
            $table->string("age")->nullable();
            $table->string("photo_path")->nullable();
            $table->unsignedDouble("height")->nullable();
            $table->string("pulse")->nullable();
            $table->string("blood_pressure")->nullable();
            $table->string("allergy")->nullable();
            $table->unsignedInteger("weight")->nullable();
            $table->string("respiration")->nullable();
            $table->string('blood_group')->nullable();
            $table->string('diet')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
