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
        Schema::create('urg_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 160);
            $table->string('email');
            $table->foreignId('id_unidad_compradora')->nullable()->constrained('cat_unidades_compradoras');
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
        Schema::dropIfExists('urg_usuarios');
    }
};
