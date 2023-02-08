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
        Schema::create('perfil_negocio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_persona')->constrained('personas');
            $table->foreignId('id_grupo_prioritario')->constrained('cat_grupos_prioritarios');
            $table->unsignedInteger('id_tipo_pyme')->nullable();
            $table->unsignedInteger('id_sector');
            $table->unsignedInteger('id_categoria_scian');
            $table->string('nombre_negocio', 100);
            $table->text('lema_negocio');
            $table->text('descripcion_negocio');
            $table->text('diferenciadores');
            $table->string('sitio_web', 255)->nullable();
            $table->string('cuenta_facebook', 240)->nullable();
            $table->string('cuenta_twitter', 240)->nullable();
            $table->string('cuenta_linkedin', 240)->nullable();
            $table->string('num_whatsapp', 15)->nullable();
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
        Schema::dropIfExists('perfil_negocio');
    }
};
