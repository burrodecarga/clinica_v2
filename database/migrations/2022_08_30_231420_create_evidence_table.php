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
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
$table->string('name');

            $table->string('file_name');
            $table->string('file_extension');
            $table->string('file_path');

            $table->boolean('verify')->default(false);
            $table->string('verify_by')->nullable();
            $table->datetime('verify_at')->nullable();
            $table->timestamps();
            $table->foreign('school_id')->references('id')->on('schools')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidence');
    }
};
