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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->string('rfc', 13)->unique();
            $table->string('nombre_razon_social');
            $table->string('direccion');
            $table->string('nombre_contacto');
            $table->string('telefono_fijo');
            $table->string('telefono_celular');
            $table->string('correo_e_principal');
            $table->string('correo_e_secundario')->nullable();
            $table->string('grupo_prioritario')->nullable();
            $table->string('lema_negocio');
            $table->string('descripcion_negocio');
            $table->string('diferenciadores');
            $table->string('sitio_web');
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
        Schema::dropIfExists('perfiles');
    }
};
