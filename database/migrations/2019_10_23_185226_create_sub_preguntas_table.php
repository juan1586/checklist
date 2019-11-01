<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre');
            
            $table->unsignedInteger('pregunta_id')->nullable(); 
            $table->timestamps();

            $table->foreign('pregunta_id')->after('id_checklist')->references('id')->on('preguntas')
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
        Schema::table('sub_preguntas', function (Blueprint $table){
            $table->dropForeign(['pregunta_id']); 
            $table->dropIfExists('sub_preguntas'); 
        });
    }
}
