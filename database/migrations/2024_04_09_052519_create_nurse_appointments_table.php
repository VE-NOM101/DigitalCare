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
        Schema::create('nurse_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_id')->nullable();
            $table->date('appointed_date');
            $table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurse_appointments');
    }
};
