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
        Schema::create('antecedent_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year');
            $table->string('name');
            $table->datetime('date')->nullable();
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('antecedent_id');
            $table->foreign('antecedent_id')->references('id')->on('antecedents')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('antecedent_user');
    }
};
