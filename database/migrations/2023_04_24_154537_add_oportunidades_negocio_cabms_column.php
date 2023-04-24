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
        Schema::table('oportunidades_negocio', function (Blueprint $table) {
            $table->string('partidas')->nullable()->change();
            $table->string('cabms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oportunidades_negocio', function (Blueprint $table) {
            $table->string('partidas', 60)->nullable()->change();
            $table->dropColumn('cabms');
        });
    }
};
