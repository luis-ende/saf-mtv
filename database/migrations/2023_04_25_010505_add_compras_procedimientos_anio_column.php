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
        Schema::table('compras_procedimientos', function (Blueprint $table) {
            $table->unsignedSmallInteger('anio');
            $table->date('fecha_estimada_procedimiento')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras_procedimientos', function (Blueprint $table) {
            $table->dropColumn('anio');
            $table->date('fecha_estimada_procedimiento')->change();
        });
    }
};
