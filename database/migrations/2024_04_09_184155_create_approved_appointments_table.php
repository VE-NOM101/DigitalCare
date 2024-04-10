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
            $table->unsignedBigInteger('request_id')->unique();
            $table->unsignedBigInteger('nurse_appointment_id')->nullable();
            $table->time('slotTime')->nullable();
            $table->foreign('request_id')->references('id')->on('requested_appointments')->onDelete('cascade');
            $table->foreign('nurse_appointment_id')->references('id')->on('nurse_appointments')->onDelete('cascade');
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
