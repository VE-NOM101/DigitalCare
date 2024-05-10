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
        Schema::create('req_live_consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('date');
            $table->string('description');
            $table->tinyInteger('status')->default(0);
            $table->string('link',512)->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('doctor_id')->on('doctors')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('req_live_consultations');
    }
};
