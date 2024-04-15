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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('salt_composition');
            $table->unsignedInteger('buying_price');
            $table->unsignedInteger('selling_price');
            $table->string('side_effect')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('quantity')->default(0);
            $table->foreign('category_id')->on('medicine_categories')->references('id');
            $table->foreign('brand_id')->on('medicine_brands')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
