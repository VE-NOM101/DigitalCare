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
        Schema::create('day_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->time('monday1')->nullable()->default('09:30:00');
            $table->time('monday2')->nullable()->default('16:00:00');
            $table->time('tuesday1')->nullable()->default('09:30:00');
            $table->time('tuesday2')->nullable()->default('16:00:00');
            $table->time('wednesday1')->nullable()->default('09:30:00');
            $table->time('wednesday2')->nullable()->default('16:00:00');
            $table->time('thursday1')->nullable()->default('09:30:00');
            $table->time('thursday2')->nullable()->default('16:00:00');
            $table->time('friday1')->nullable()->default('09:30:00');
            $table->time('friday2')->nullable()->default('16:00:00');
            $table->time('saturday1')->nullable()->default('09:30:00');
            $table->time('saturday2')->nullable()->default('16:00:00');
            $table->time('sunday1')->nullable()->default('09:30:00');
            $table->time('sunday2')->nullable()->default('16:00:00');
            $table->string('per_patient_time')->nullable()->default('30');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_schedules');
    }
};
