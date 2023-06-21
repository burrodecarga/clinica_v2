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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger("proof_id")->nullable();
$table->string("proof")->nullable();
$table->string("name")->nullable();
$table->string("unit")->nullable();
$table->double("max_value_male")->default(0);
$table->double("min_value_male")->default(0);
$table->double("max_value_female")->default(0);
$table->double("min_value_female")->default(0);
$table->double("max_value_children")->default(0);
$table->double("min_value_children")->default(0);
$table->text('observations')->nullable();

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
        Schema::dropIfExists('parameters');
    }
};
