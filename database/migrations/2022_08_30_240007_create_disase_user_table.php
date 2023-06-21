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
        Schema::create('disase_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year');
            $table->string('name')->nullable();

            $table->string('condition')->default('aguda'); //cronica-aguda
            $table->boolean('inherited')->default(false);
            $table->boolean('deceased')->default(false);
            $table->text('observation')->nullable();
            $table->string('doctor')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();

            $table->unsignedBigInteger('disase_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('disase_id')->references('id')->on('disases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('disase_user');
    }
};
