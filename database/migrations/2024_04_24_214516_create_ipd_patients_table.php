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
        Schema::create('ipd_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('admission_date');
            $table->unsignedBigInteger('bed_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('note');
            $table->foreign('patient_id')->on('patients')->references('id');
            $table->foreign('doctor_id')->on('doctors')->references('id');
            $table->foreign('bed_id')->on('bed_types')->references('id');
            $table->foreign('invoice_id')->on('patient_invoices')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_patients');
    }
};
