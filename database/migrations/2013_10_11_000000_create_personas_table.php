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
            $table->char('id_tipo_persona', 1); // "F" = "Física" | "M" = "Moral"
            $table->bigInteger('personable_id');
            $table->string('personable_type', 30);
            $table->integer('id_asentamiento')->nullable();
            $table->integer('id_tipo_vialidad')->nullable();
            $table->string('vialidad', 120)->nullable();
            $table->string('num_ext', 100)->nullable();
            $table->string('num_int', 80)->nullable();
            $table->string('email');
            $table->unsignedSmallInteger('registro_fase')->default(1);
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
