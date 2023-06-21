<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->bigInteger('specialty_id');
            $table->string('office')->nullable();
            $table->date('date');
            $table->time('hour');
            $table->bigInteger('hour_id');
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->double('price')->default(0);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appoinments');
    }
};
