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
        Schema::create('medicine_purchase_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('medicine_purchase_id');
            $table->unsignedBigInteger('medicine_id');
            $table->unsignedBigInteger('lot_no');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('tax');
            $table->double('amount');
            $table->foreign('medicine_purchase_id')->references('id')->on('medicine_purchases')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_purchase_pivot');
    }
};
