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
        Schema::create('persona_info_fiscal', function (Blueprint $table) {
            $table->id();            
            $table->integer('id_asentamiento');
            $table->integer('id_tipo_vialidad');
            $table->string('vialidad', 120);
            $table->string('num_int', 80);
            $table->string('num_ext', 100);                        
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
        Schema::dropIfExists('persona_info_fiscal');
    }
};
