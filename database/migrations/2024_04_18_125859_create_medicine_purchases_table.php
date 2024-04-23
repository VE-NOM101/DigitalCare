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
        Schema::create('medicine_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacist_id');
            $table->text('note');
            $table->unsignedBigInteger('discount');
            $table->double('net');
            $table->string('payment_method');
            $table->timestamps();
            $table->foreign('pharmacist_id')->references('id')->on('pharmacists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_purchases');
    }
};
