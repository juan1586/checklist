<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pregunta');
            $table->boolean('respuesta')->default(false);
            $table->time('hora');
            $table->date('fecha');            
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_checklist');
            $table->timestamps();

            $table->foreign('id_pregunta')->references('id')->on('preguntas')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_usuario')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_checklist')->references('id')->on('checklists')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
