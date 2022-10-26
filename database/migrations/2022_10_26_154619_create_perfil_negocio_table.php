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
            $table->text('lema_negocio');
            $table->text('descripcion_negocio');
            $table->string('diferenciadores');
            $table->string('sitio_web', 255);
            $table->string('cuenta_facebook', 240);
            $table->string('cuenta_twitter', 240);
            $table->string('cuenta_linkedin', 240);
            $table->string('num_whatsapp', 15);
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
