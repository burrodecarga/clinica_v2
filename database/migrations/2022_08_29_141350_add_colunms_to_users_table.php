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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cedula')->nullable()->after('name');
            $table->string('address')->nullable()->after('name');
            $table->string('phone')->nullable()->after('name');
            $table->string('gender')->default('masculino')->after('name');
            $table->date('birthdate')->default(now())->after('name');
            $table->boolean('isDoctor')->after('name')->default(false);
            $table->boolean('active')->after('name')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
            $table->dropColumn('birthdate');
            $table->dropColumn('cedula');
            $table->dropColumn('isDoctor');
            $table->dropColumn('active');
        });
    }
};
