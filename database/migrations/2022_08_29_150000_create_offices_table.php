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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('local');
            $table->string('address');
            $table->string('phone');
            $table->string('mobil')->nullable();
            $table->string('email')->nullable();
            $table->string('map')->nullable();
            $table->string('lat')->nullable();
            $table->string('lgn')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();

            $table->foreign('doctor_id')->references('id')->on('users');

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
        Schema::dropIfExists('offices');
    }
};
