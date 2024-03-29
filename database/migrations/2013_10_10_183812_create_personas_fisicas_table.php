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
        Schema::create('personas_fisicas', function (Blueprint $table) {
            $table->id();
            $table->string('curp', 18);
            $table->date('fecha_nacimiento');
            $table->char('genero', 1);
            $table->string('nombre', 120);
            $table->string('primer_ap', 60);
            $table->string('segundo_ap', 60)->nullable();
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
        Schema::dropIfExists('personas_fisicas');
    }
};
