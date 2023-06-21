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
        Schema::create('surgery_user', function (Blueprint $table) {
            $table->id();
$table->string('name')->nullable();

            $table->unsignedBigInteger('year');
            $table->string('type')->default('electiva'); //mayor-menor-emergencia-electiva
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('surgery_id')->references('id')->on('surgeries')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('surgery_user');
    }
};
