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
        Schema::create('approved_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->unique();
            $table->unsignedBigInteger('request_id')->unique();
            $table->unsignedBigInteger('nurse_id')->nullable();
            $table->time('intime')->nullable();
            $table->time('outtime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approved_appointments');
    }
};
