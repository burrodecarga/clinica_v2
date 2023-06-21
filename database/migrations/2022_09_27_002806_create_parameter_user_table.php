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
        Schema::create('parameter_user', function (Blueprint $table) {
            $table->id();
$table->string("proof")->nullable();
$table->string("name")->nullable();
$table->double('value');
$table->date('date');
$table->unsignedBigInteger('proff_id')->nullable();
$table->foreignId('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
$table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('parameter_user');
    }
};
