<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->text('Descripcion')->nullable();
            $table->date('Fecha_inicial')->nullable();
            $table->date('Fecha_final')->nullable();
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
        Schema::dropIfExists('frecuencias');
    }
}
