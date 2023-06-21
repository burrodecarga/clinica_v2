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
        Schema::create('interview_symptom', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('symptom_id')->nullable();
            $table->unsignedBigInteger('interview_id')->nullable();
            $table->foreign('symptom_id')->references('id')->on('symptoms')
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
        Schema::dropIfExists('interview_symptom');
    }
};
