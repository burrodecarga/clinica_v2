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
        Schema::create('interview_medicine', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('dose')->nullable();
            $table->string('dose_unit')->nullable();
            $table->string('num_frecuency')->nullable();
            $table->string('frecuency')->nullable();
            $table->string('num_duration')->nullable();
            $table->string('duration')->nullable();
            $table->text('instruction')->nullable(); $table->unsignedBigInteger('interview_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();

            $table->foreign('medicine_id')->references('id')->on('medicines')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('interview_id')->references('id')->on('interviews')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('interview_medicine');
    }
};
