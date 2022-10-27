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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('rfc', 13)->unique();
            $table->string('nombre', 120);
            $table->string('primer_ap', 60)->nullable();
            $table->string('segundo_ap', 60)->nullable();
            $table->string('nombre_contacto', 120)->nullable();
            $table->integer('id_asentamiento');
            $table->integer('id_tipo_vialidad');
            $table->string('vialidad', 120);
            $table->string('num_int', 80)->nullable();
            $table->string('num_ext', 100);
            $table->string('lada', 8);
            $table->string('telefono_fijo', 10);
            $table->string('extension', 8)->nullable();
            $table->string('telefono_movil', 12);
            $table->string('email', 255);
            $table->string('email_alterno', 255)->nullable();
            $table->string('grupo_prioritario')->nullable();
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
        Schema::dropIfExists('personas');
    }
};
