<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('department_id')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->string('specialist')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
