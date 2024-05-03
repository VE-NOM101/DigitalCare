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
        Schema::create('campaignes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->date('from_date');
            $table->date('to_date');
            $table->time('time');
            $table->string('photo_path');
            $table->string('description', 512);
            $table->boolean('isActive')->default(0);
            $table->string("type")->default("free");
            $table->unsignedInteger("reg_fee")->default(0);
            $table->string("form_link",512)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaignes');
    }
};
